<template>
	<div class="card">
		<div class="card-header">{{ __('app.stats.products') }}</div>
		<div class="">
			<b-table-simple hover caption-top fixed class="text-center">
				<b-thead>
					<b-tr>
						<b-th>{{ __('app.common.products_number') }}</b-th>
						<b-th>{{ __('app.common.available') }}</b-th>
						<b-th>{{ __('app.common.out_stock') }}</b-th>
						<b-th>{{ __('app.common.stock') }}</b-th>
					</b-tr>
				</b-thead>
				<b-tbody>
					<b-tr>
                  <b-td>{{ stats.total }}</b-td>
						<b-td>{{ stats.av }}</b-td>
						<b-td>{{ stats.outOfStock }}</b-td>
						<b-td>{{ stats.quantityStock }}</b-td>
					</b-tr>
				</b-tbody>
			</b-table-simple>
		</div>
	</div>
</template>

<script>
export default {
   props: {
      stats: Object
   },
	computed: {

	},
	methods: {

	},
	created() {
	}
}
</script>

<style>
</style>
