<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>

			{{ __('app.clients.title') }}
			<button
				@click.prevent="showCreateForm = true"
				class="btn btn-success btn-sm reverse-float"
			>
				<i class="fas fa-plus"></i>
				{{ __('app.common.create') }}
			</button>
		</div>

		<div class="card-body">
			<x-table :items="clients" :fields="fields" :busy="loading">
				<template v-slot:cell(control)="row">
					<a href="#" class="text-primary" @click.prevent="edit(row.item)">
						<i class="fas fa-fw fa-lg fa-edit"></i>
					</a>
					<a href="#" class="text-danger" @click.prevent="destroy(row.item)">
						<i class="fas fa-times fa-fw fa-lg"></i>
					</a>
				</template>
			</x-table>
		</div>

		<create-client v-if="showCreateForm" @close-modal="showCreateForm = false" @succeed="succeed"></create-client>

		<edit-client
			v-if="showEditForm"
			@close-modal="showEditForm = false"
			:client="clientEdit"
			@succeed="succeed"
		></edit-client>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showCreateForm: false,
			showEditForm: false,
			clients: [],
			fields: [
				{ key: 'id', label: '#' },
				{ key: 'name', label: this.__('app.common.name') },
				{ key: 'phone', label: this.__('app.common.phone') },
				{ key: 'email', label: this.__('app.common.email') },
				{ key: 'address', label: this.__('app.common.address') },
				{ key: 'control', label: this.__('app.common.control'), class: 'text-center' }
			],
         clientEdit: null,
         loading: true
		}
	},
	methods: {
		getData() {
			this.fetchData('/api/clients').then(data => {
            this.clients = data
            this.loading = false
			})
		},
		edit(item) {
			this.clientEdit = item
			this.showEditForm = true
		},
		destroy(item) {
			this.deleteData(`/api/clients/${item.id}`).then(res => {
				if (res === 'deleted') {
					this.getData()
				}
			})
		},
		succeed() {
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
