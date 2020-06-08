<template>
	<b-modal
		v-model="show"
		@hidden="hideModal"
		:title="__('app.purchases.create')"
		size="xl"
		no-close-on-backdrop
		:ok-title="__('app.common.close')"
		ok-only
	>
		<form v-if="!thereIsInvoice">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="supplier">{{ __("app.common.supplier") }}</label>
					<select
						class="form-control"
						id="supplier"
						v-model="form.supplier"
						:class="{ 'is-invalid': formErrors.supplier }"
					>
						<option :value="undefined" disabled>{{ __("app.suppliers.select") }}</option>
						<option
							v-for="supplier in suppliers"
							:key="supplier.id"
							:value="supplier.id"
						>{{ supplier.name }}</option>
					</select>
					<div v-if="formErrors.supplier" class="invalid-feedback">{{ formErrors.supplier[0] }}</div>
				</div>

				<div class="form-group col-md-4">
					<label for="payment-type">{{ __("app.common.payment_type") }}</label>
					<select
						class="form-control"
						id="payment-type"
						v-model="form.paymentType"
						:class="{'is-invalid': formErrors.paymentType}"
					>
						<option :value="undefined" disabled>{{ __("app.common.choose") }}</option>
						<option
							v-for="(type, index) in $config.payment_type"
							:key="index"
							:value="type"
						>{{ __(`app.payment_type.${type}`) }}</option>
					</select>
					<div class="invalid-feedback" v-if="formErrors.paymentType">{{ formErrors.paymentType[0] }}</div>
				</div>

				<div class="form-group col-md-4">
					<label for="payment-status">{{ __("app.common.payment_status") }}</label>
					<select
						class="form-control"
						id="payment-status"
						v-model="form.paymentStatus"
						:class="{'is-invalid': formErrors.paymentStatus}"
					>
						<option :value="undefined" disabled>{{ __("app.common.choose") }}</option>
						<option
							v-for="(status, index) in $config.payment_status"
							:key="index"
							:value="status"
						>{{ __(`app.payment_status.${status}`) }}</option>
					</select>
					<div class="invalid-feedback" v-if="formErrors.paymentStatus">{{ formErrors.paymentStatus[0] }}</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="note">{{ __('app.common.note') }}</label>
					<textarea
						v-model="form.note"
						class="form-control"
						id="note"
						rows="3"
						required
						:class="{'is-invalid': formErrors.note}"
					></textarea>
					<div v-if="formErrors.note" class="invalid-feedback">{{ formErrors.note[0] }}</div>
				</div>
			</div>

			<button
				class="btn btn-success d-block w-100"
				@click.prevent="createInvoice"
			>{{ __('app.purchases.add_invoice') }}</button>
		</form>

		<div v-else class="invoice-info">
			<create-purchase-details
				v-if="showCreateDetailsForm"
				@close-modal="showCreateDetailsForm = false"
				@detail-created="getInvoiceDetails"
				:invoice="invoice"
			></create-purchase-details>

			<show-purchase-details :invoice="invoice" :items="invoiceDetails" @invoice_detail_deleted="getInvoiceDetails"></show-purchase-details>

			<button
				class="btn btn-primary d-block w-100"
				@click.prevent="createInvoiceDetails"
			>{{ __('app.products.create') }}</button>
		</div>
	</b-modal>
</template>

<script>
export default {
	data() {
		return {
			show: true,
			showCreateDetailsForm: false,
			suppliers: [],
			form: {},
			formErrors: {},
			invoice: {}, // invoice
			invoiceDetails: [],
		}
	},
	computed: {
		thereIsInvoice() {
			return Object.keys(this.invoice).length !== 0
		},
	},
	methods: {
		getSuppliers() {
			this.fetchData(`/api/suppliers`).then(data => {
				this.suppliers = data
			})
		},
		getInvoiceDetails() {
			// when detail created
			this.fetchData(`/api/invoices/${this.invoice.id}`).then(res => {
				this.invoiceDetails = res.details
				this.showCreateDetailsForm = false
			})
		},
		createInvoiceDetails() {
			this.showCreateDetailsForm = true
		},
		createInvoice() {
			this.formErrors = {}
			this.postData(`/api/invoices`, this.form).then(res => {
				if (res.status === 'success') {
					this.invoice = res.data
				} else if (res.status === 'error') {
					this.formErrors = res.message
				}
			})
		}
	},
	created() {
		this.getSuppliers()
	}
}
</script>

