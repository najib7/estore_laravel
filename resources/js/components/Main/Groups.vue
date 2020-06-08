<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>

			{{ __('app.groups.title') }}
			<button
				@click.prevent="showCreateForm = true"
				class="btn btn-success btn-sm reverse-float"
			>
				<i class="fas fa-plus"></i>
				{{ __('app.common.create') }}
			</button>
		</div>

		<div class="card-body">
			<x-table :items="groups" :fields="fields" :busy="loading">
				<template v-slot:cell(control)="row">
					<a href="#" class="text-warning" @click.prevent="privileges(row.item)">
						<i class="fas fa-fw fa-lg fa-traffic-light"></i>
					</a>
					<a href="#" class="text-primary" @click.prevent="edit(row.item)">
						<i class="far fa-fw fa-lg fa-edit"></i>
					</a>
					<a href="#" class="text-danger" @click.prevent="destroy(row.item)">
						<i class="fas fa-times fa-fw fa-lg"></i>
					</a>
				</template>
			</x-table>
		</div>

		<create-group v-if="showCreateForm" @close-modal="showCreateForm = false" @succeed="succeed"></create-group>

		<edit-group
			v-if="showEditForm"
			:group="groupEdit"
			@close-modal="showEditForm = false"
			@succeed="succeed"
		></edit-group>

      <users-privileges
         v-if="showPrivilegesForm"
         :group="groupEdit"
         @close-modal="showPrivilegesForm = false"
         @succeed="succeed"
      ></users-privileges>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showCreateForm: false,
			showEditForm: false,
         showPrivilegesForm: false,
			groups: [],
			fields: [
				{ key: 'id', label: '#' },
				{ key: 'name', label: this.__('app.groups.name') },
				{ key: 'description', label: this.__('app.groups.description') },
				{ key: 'control', label: this.__('app.common.control'), class: 'text-center' }
			],
         groupEdit: null,
         loading: true
		}
	},
	methods: {
		getData() {
			this.fetchData('/api/groups').then(data => {
            this.groups = data
            this.loading = false
			})
		},
		edit(item) {
			this.groupEdit = item
			this.showEditForm = true
		},
		destroy(group) {
			this.deleteData(`/api/groups/${group.id}`).then(res => {
				if (res === 'deleted') {
					this.getData()
				}
			})
		},
      privileges(item) {
			this.groupEdit = item
         this.showPrivilegesForm = true

      },
		succeed(message) {
			this.getData()
			this.showEditForm = false
         this.showCreateForm = false
         this.showPrivilegesForm = false
		}
	},
	created() {
		this.getData()
	}
}
</script>
