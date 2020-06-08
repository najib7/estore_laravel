<template>
	<div class="card">
		<div class="card-header">{{ __('app.stats.purchases') }}</div>
		<div class>
			<b-table-simple hover caption-top fixed class="text-center">
				<b-thead>
					<b-tr>
						<b-th>{{ __('app.stats.number_of_purchases') }}</b-th>
						<b-th>{{ __('app.stats.total_purchases') }}</b-th>
						<b-th>{{ __('app.common.expenses') }}</b-th>
					</b-tr>
				</b-thead>
				<b-tbody>
					<b-tr>
						<b-td>{{ stats.count }}</b-td>
						<b-td>{{ stats.quantity }}</b-td>
						<b-td>{{ price(stats.total_price) }}</b-td>
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
   }
}
</script>

<style>
</style>
