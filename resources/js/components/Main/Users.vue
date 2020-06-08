<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>

			{{ __('app.users.title') }}
			<button
				@click.prevent="showCreateForm = true"
				class="btn btn-success btn-sm reverse-float"
			>
				<i class="fas fa-plus"></i>
				{{ __('app.common.create') }}
			</button>
		</div>

		<div class="card-body">
			<x-table :items="users" :fields="fields" :busy="loading">
				<template v-slot:cell(full_name)="data">{{ `${data.item.first_name} ${data.item.last_name}` }}</template>

				<template v-slot:cell(control)="row">
					<a href="#" class="text-success" @click.prevent="info(row.item)">
						<i class="fas fa-eye fa-fw fa-lg"></i>
					</a>
					<a href="#" v-if="canUpdate" class="text-primary" @click.prevent="edit(row.item)">
						<i class="fas fa-fw fa-lg fa-edit"></i>
					</a>
					<a href="#" class="text-danger" @click.prevent="destroy(row.item)">
						<i class="fas fa-times fa-fw fa-lg"></i>
					</a>
				</template>
			</x-table>
		</div>

		<create-user v-if="showCreateForm" @close-modal="showCreateForm = false" @succeed="succeed"></create-user>

		<edit-user
			v-if="showEditForm && canUpdate"
			@close-modal="showEditForm = false"
			:user="userEdit"
			@succeed="succeed"
		></edit-user>

		<user-details v-if="showUserDetails" @close-modal="showUserDetails = false" :info="userInfo"></user-details>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showCreateForm: false,
			showUserDetails: false,
			showEditForm: false,
			users: [],
			fields: [
				{ key: 'id', label: '#' },
				{ key: 'username', label: this.__('app.common.username') },
				{ key: 'full_name', label: this.__('app.common.full_name') },
				{ key: 'email', label: this.__('app.common.email') },
				{ key: 'phone', label: this.__('app.common.phone') },
				{ key: 'group', label: this.__('app.common.group') },
				{ key: 'last_login', label: this.__('app.common.last_login') },
				{ key: 'control', label: this.__('app.common.control'), class: 'text-center' }
			],
			userInfo: null,
         userEdit: null,
         loading: true
		}
	},
	props: {
		canUpdate: Boolean
	},
	methods: {
		getData() {
			this.fetchData('/api/users').then(data => {
            this.users = data
            this.loading = false
			})
		},
		info(item) {
			this.userInfo = item
			this.showUserDetails = true
		},
		edit(item) {
			this.userEdit = item
			this.showEditForm = true
		},
		destroy(user) {
			this.deleteData(`/api/users/${user.id}`).then(res => {
				if (res === 'deleted') {
					this.getData()
				}
			})
		},
		succeed(message) {
			this.getData()
			this.showEditForm = false
			this.showCreateForm = false
		}
	},
	created() {
		this.getData()
	}
}
</script>
