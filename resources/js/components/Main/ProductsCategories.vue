<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>

			{{ __('app.products_categories.title') }}
			<button
				@click.prevent="showCreateForm = true"
				class="btn btn-success btn-sm reverse-float"
			>
				<i class="fas fa-plus"></i>
				{{ __('app.common.create') }}
			</button>
		</div>

		<div class="card-body">
			<x-table :items="items" :fields="fields" :busy="loading">
				<template v-slot:cell(control)="row">
					<a href="#" @click.prevent="edit(row.item)" class="text-primary">
						<i class="fas fa-fw fa-lg fa-edit"></i>
					</a>
					<a href="#" @click.prevent="destroy(row.item)" class="text-danger">
						<i class="fas fa-times fa-fw fa-lg"></i>
					</a>
				</template>
			</x-table>
		</div>

		<!-- modal create new product category -->
		<create-product-category
			v-if="showCreateForm"
			@close-modal="showCreateForm = false"
			@succeed="succeed"
		></create-product-category>

		<edit-product-category
			v-if="showEditForm"
			@close-modal="showEditForm = false"
			@succeed="succeed"
			:category="category"
		></edit-product-category>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showCreateForm: false,
			showEditForm: false,
			showTestForm: false,
			fields: [
				{ key: "id", label: "#", sortable: true },
				{
					key: "name",
					label: this.__("app.common.name"),
					sortable: true
				},
				{
					key: "description",
					label: this.__("app.products_categories.description"),
					sortable: true
				},
				{ key: "image", label: this.__("app.common.image") },
				{ key: "control", label: this.__("app.common.control"), class: 'text-center' }
			],
			items: [],
         category: {},
         loading: true
		};
	},
	methods: {
		getData() {
			this.fetchData(`/api/productscategories`).then(data => {
            this.items = data
            this.loading = false
			})
		},
		edit(item) {
			this.category = {
				id: item.id,
				name: item.name,
				description: item.description,
				image: item.image
			}
			this.showEditForm = true
		},
		destroy(item) {
			this.deleteData(`/api/productscategories/${item.id}`).then(res => {
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
};
</script>
