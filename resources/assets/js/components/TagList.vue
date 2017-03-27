<template>
	<div id="tags" class="tagContainer">

		<div id="addTag" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Таг нэмэх</h4>
		      </div>
		      <div class="modal-body">
		      	<form>
		      		<div class="form-group">
					    <label for="name">Нэр</label>
					    <input type="text" class="form-control" id="name" placeholder="Нэр ..." v-model="newTag.name">
					</div>
					<div class="form-group">
					    <label for="icon">Айкон</label>
					    <input type="text" class="form-control" id="icon" placeholder="Айкон ..." v-model="newTag.icon">
					</div>
					<div class="form-group">
					    <input type="radio" id="one" value="N" v-model="newTag.type">
						<label for="one">Нэр үг</label>
						<br>
						<input type="radio" id="two" value="A" v-model="newTag.type">
						<label for="two">Тэмдэг нэр</label>
						<br>
						<span>Picked: {{ newTag.type }}</span>
					</div>

		      	</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Болих</button>
		        <button @click="saveTag()" type="button" class="btn btn-primary">Хадгалах</button>
		      </div>
		    </div>
		  </div>
		</div>

		<h4>Тагууд</h4>
		<div class="row">
			<a class="btn btn-success" @click="setNewTag()">
			Нэмэх
			</a>
		</div>
		<div class="row">
			<div class="content table-responsive table-full-width">
	            <table class="table table-hover table-striped">
	                <thead>
	                    <tr>
		                    <th>Нэр</th>
		                	<th>Айкон</th>
		                	<th>Төрөл</th>
		                	<th>Засах</th>
		                	<th>Устгах</th>
	                	</tr>
	                </thead>
	                <tbody>
						<tr v-for="tag in tags">
							<td>
								{{tag.name}}
							</td>
	                    	<td>{{tag.icon}}</td>
	                    	<td>
	                    		{{tag.type}}
	                    	</td>
	                    	<td style="width: 70px;">
	                    		<a @click="editTag(tag)">
	                    			<i class="fa fa-edit"></i>
	                    		</a>
	                    	</td>
	                    	<td style="width: 70px;">
	                    		<a>
	                    			<i class="fa fa-trash"></i>
	            				</a>
	                    	</td>
	                    </tr>   	
	                </tbody>
	            </table>
	        </div>
		</div>
	</div>
</template>
<script>
	import api from '../env'

	export default {
		data() {
			return {
				tags: [],
				newTag: {},
				state: 'insert',
				instanceTag: {},
			}
		},

		mounted() {

		},

		created() {
			this.setNewTag()
			this.getTags()
		},

		methods: {
			getTags() {
				axios.get(api.APP_URI + 'api/tag').then(res => {
					this.tags = res.data.result
				})
			},

			saveTag() {
				let data = new FormData()

				data.append('name', this.newTag.name)
				data.append('icon', this.newTag.icon)
				data.append('type', this.newTag.type)

				if(this.state == 'insert') {
					this.insertTag(data)
				} else {
					this.updateTag(this.newTag.id, data)
				}
			},

			insertTag(data) {
				axios.post(api.APP_URI + 'api/tag', data).then(res => {
					if(res.data.code == 0) {
						this.tags.unshift(res.data.result)
						$('#addTag').modal('hide')
					}
				})
			},

			updateTag(id, data) {
				data.append('_method', 'PATCH')
				axios.post(api.APP_URI + 'api/tag/' + id, data).then(res => {
					if(res.data.code == 0) {
						//this.instanceTag = res.data.result
						Object.assign(this.instanceTag, res.data.result)
						$('#addTag').modal('hide')
					}
				})	
			},

			editTag(tag) {
				this.newTag = Object.assign({}, tag)
				this.instanceTag = tag
				this.setState('edit')
				$('#addTag').modal('show')
			},

			setNewTag() {
				this.newTag = {
					name: '',
					icon: '',
					type: 'N',
				}

				this.setState('insert')
				$('#addTag').modal('show')
			},

			setState(state) {
				this.state = state
			}
		}
	}
</script>
<style lang="scss">
	.tagContainer {
		padding: 20px;
	}
</style>