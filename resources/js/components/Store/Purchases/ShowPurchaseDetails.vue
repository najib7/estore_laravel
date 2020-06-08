<template>
	<div>
		<div class="invoice-info my-4">
			<div class="d-flex justify-content-between">
				<div>
					{{ __('app.purchases.invoice_id') }}:
					<span class="font-weight-bold">{{ invoice.id }}</span>
				</div>
				<div>
					{{ __('app.common.supplier') }}:
					<span class="font-weight-bold">{{ invoice.supplier }}</span>
				</div>
				<div>
					{{ __('app.common.payment_status') }}:
					<span
						class="font-weight-bold"
					>{{ __(`app.payment_status.${invoice.payment_status}`) }}</span>
				</div>
				<div>
					{{ __('app.common.payment_type') }}:
					<span
						class="font-weight-bold"
					>{{ __(`app.payment_type.${invoice.payment_type}`) }}</span>
				</div>
			</div>
		</div>

		<b-table
			striped
			hover
			small
			:items="items"
			:fields="detailsFields"
			show-empty
			:empty-text="__('app.common.no_records')"
		>
			<template v-slot:cell(control)="row">
				<a href="#" class="text-danger" @click.prevent="destroy(row.item, row.index)">
					<i class="fas fa-times fa-fw fa-lg"></i>
				</a>
			</template>

			<template v-slot:custom-foot>
				<b-tr>
					<b-td colspan="5"></b-td>
					<b-td colspan="2" variant="primary" class="font-weight-bold">{{ price(sum) }}</b-td>
				</b-tr>
			</template>
		</b-table>
	</div>
</template>

<script>
export default {
	data() {
		return {
			detailsFields: [
				{ key: 'id', label: '#' },
				{ key: 'product.name', label: this.__('app.products.name') },
				{ key: 'product.id', label: this.__('app.products.id') },
				{ key: 'product.category.name', label: this.__('app.products.category') },
				{ key: 'quantity', label: this.__('app.common.quantity') },
				{
               key: 'price',
               label: this.__('app.common.price'),
               formatter: (value, key, item) => this.price(value)
            },
				{ key: 'control', label: this.__('app.common.delete') },
			]
		}
	},
	props: {
		items: Array,
		invoice: Object,
	},
	computed: {
		sum() {
			if (this.items.length !== 0) {
				let prices = this.items.map((element) => {
					return parseFloat(element.price) * element.quantity
				})
				return this.toFixed(prices.reduce((a, b) => a + b))
			} else {
				return 0
			}
		}
	},
	methods: {
		destroy(item, index) {
			this.deleteData(`/api/purchases/details/${item.id}`).then(res => {
				if (res === 'deleted') {
					this.$emit('invoice_detail_deleted', index)
				}
			})
		}
	}
}
</script>

<style>
</style>
