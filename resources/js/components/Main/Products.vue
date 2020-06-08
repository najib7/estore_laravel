<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>

			{{ __('app.products.title') }}
			<button
				@click.prevent="showCreateForm = true"
				class="btn btn-success btn-sm reverse-float"
			>
				<i class="fas fa-plus"></i>
				{{ __('app.common.create') }}
			</button>
		</div>

		<div class="card-body">
			<x-table :items="products" :fields="fields" :busy="loading">
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

		<create-product v-if="showCreateForm" @close-modal="showCreateForm = false" @succeed="succeed"></create-product>

		<edit-product
			v-if="showEditForm"
			@close-modal="showEditForm = false"
			@succeed="succeed"
			:product="product"
		></edit-product>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showCreateForm: false,
			showEditForm: false,
			fields: [
				{ key: "id", label: "#", sortable: true },
				{
					key: "name",
					label: this.__("app.common.name"),
					sortable: true
				},
				{
					key: "category.name",
					label: this.__("app.products.category"),
					sortable: true
				},
				{ key: "sales_count", label: this.__("app.products.sales_count"), sortable: true },
				{
					key: "quantity",
					label: this.__("app.products.quantity"),
					sortable: true
				},
				{
					key: "price",
					label: this.__("app.products.price"),
               sortable: true,
               formatter: (value, key, item) => this.price(value)
				},
				{ key: "control", label: this.__("app.common.control"), class: 'text-center' }
			],
			products: [],
         product: {},
         loading: true
		}
	},
	methods: {
		getData() {
			this.fetchData('/api/products').then(data => {
            this.products = data
            this.loading = false
			})
		},
		edit(item) {
			this.product = item
			this.showEditForm = true
		},
		succeed() {
			this.getData()
			this.showEditForm = false
			this.showCreateForm = false
		},
		destroy(product) {
			this.deleteData(`/api/products/${product.id}`).then(res => {
				if (res === 'deleted') {
					this.getData()
				}
			})
		}
	},
	created() {
		this.getData()
	}
}
</script>
