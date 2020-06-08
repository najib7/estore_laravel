<template>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>
			{{ __('app.sales.title') }}
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
				<template v-slot:cell(discount)="row">{{ `${Math.round(row.item.discount * 100)}%` }}</template>

				<template v-slot:cell(control)="row">
					<a href="#" class="text-success" @click.prevent="showDetail(row.item.details, row.item)">
						<i class="fas fa-eye fa-fw fa-lg"></i>
					</a>
					<a :href="`/print/sale/${row.item.id}`" class="text-primary">
						<i class="fas fa-print fa-fw fa-lg"></i>
					</a>
					<a href="#" class="text-danger" @click.prevent="destroy(row.item)">
						<i class="fas fa-times fa-fw fa-lg"></i>
					</a>
				</template>
			</x-table>
		</div>

		<create-sale v-if="showCreateForm" @close-modal="closeModal"></create-sale>

		<b-modal
			v-model="showDetails"
			:title="__('app.common.show_invoice_details', {invoice: invoice.id})"
			size="xl"
			hide-footer
		>
			<show-sales-details :invoice="invoice" :items="details"></show-sales-details>
		</b-modal>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showCreateForm: false,
			showDetails: false,
			items: [],
			fields: [
				{ key: 'id', label: '#', sortable: true },
				{ key: 'client', label: this.__('app.common.client'), sortable: true },
				{ key: 'user', label: this.__('app.common.user'), sortable: true },
				{
					key: 'count',
					label: this.__('app.common.number_of_products'),
					class: 'text-center tdwidth',
					formatter: (value, key, item) => item.details.length,
					sortByFormatted: true,
					sortable: true
				},
				{
               key: 'payment_type',
               label: this.__('app.common.payment_type'),
					formatter: (value, key, item) => this.__(`app.payment_type.${value}`),
            },
				{
               key:'payment_status',
               label: this.__('app.common.payment_status'),
					formatter: (value, key, item) => this.__(`app.payment_status.${value}`),
            },
				{ key: 'discount', label: this.__('app.common.discount') },
				{ key: 'note', label: this.__('app.common.note') },
				{ key: 'control', label: this.__('app.common.control'), class: 'text-center' }
			],
			details: [],
			invoice: {},
         loading: true
		}
	},
	methods: {
		getData() {
			this.fetchData(`/api/sales`).then(data => {
            this.items = data
            this.loading = false
			})
		},
		showDetail(details, invoice) {
			this.details = details
			this.invoice = invoice
			this.showDetails = true
		},
		destroy(invoice) {
			this.deleteData(`/api/sales/${invoice.id}`).then(res => {
				if (res === 'deleted') {
					this.getData()
				}
			})
		},
		closeModal() {
			this.showCreateForm = false
			this.getData()
		}
	},
	created() {
		this.getData()
		eventBus.$on('delete-sale-detail', (index) => {
			this.details.splice(index, 1)
		})
	},
	mounted() {
	}
}
</script>

<style lang="scss">
</style>
