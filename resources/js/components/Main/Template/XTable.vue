<template>
	<div>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div>
					<label class="d-inline-block">
						<select
							v-model="perPage"
							aria-controls="dataTable"
							class="custom-select custom-select-sm form-control form-control-sm"
						>
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
					</label>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="dataTables_filter">
					<label class="reverse-float">
						<input
							type="search"
							v-model="filter"
							class="form-control form-control-sm"
							:placeholder="__('app.common.search')"
							aria-controls="dataTable"
						/>
					</label>
				</div>
			</div>
		</div>

		<table-wrapper
			id="table"
			class="table table-bordered x-table"
			hover
			sort-by="id"
			sort-desc
			:items="items"
			:fields="fields"
			:filter="filter"
			:current-page="currentPage"
			:per-page="perPage"
			:busy="busy"
         show-empty
         :empty-text="__('app.common.no_data')"
			head-variant="light"
		>
			<template v-slot:table-busy>
				<div class="text-center text-danger my-2">
					<b-spinner class="align-middle"></b-spinner>
					<strong>{{ __('app.common.loading') }}...</strong>
				</div>
			</template>

			<!-- <template v-slot:table-caption>{{ items.length }} {{ __('app.common.records') }}</template> -->
		</table-wrapper>

		<b-pagination
			v-model="currentPage"
			:total-rows="rows"
			:per-page="perPage"
			aria-controls="table"
			align="center"
			:first-text="__('app.pagination.first')"
			:prev-text="__('app.pagination.prev')"
			:next-text="__('app.pagination.next')"
			:last-text="__('app.pagination.last')"
		></b-pagination>
	</div>
</template>

<script>
export default {
	data() {
		return {
			currentPage: 1,
			perPage: 10,
			filter: null,
			// busy: true
		}
	},
	props: {
		items: Array,
		fields: Array,
		busy: Boolean
	},
	computed: {
		rows() {
			return this.items.length
		}
	},
}
</script>

<style>
</style>
