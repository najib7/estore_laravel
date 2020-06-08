<template>
	<b-modal
		v-model="show"
		@hidden="hideModal"
		:title="__('app.sales.create')"
		size="xl"
		no-close-on-backdrop
		:ok-title="__('app.common.close')"
		ok-only
	>
		<form v-if="!thereIsInvoice">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="client">{{ __("app.common.client") }}</label>
					<select
						class="form-control"
						id="client"
						v-model="form.client"
						:class="{ 'is-invalid': formErrors.client }"
					>
						<option :value="undefined" disabled>{{ __("app.clients.select") }}</option>
						<option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
					</select>
					<div v-if="formErrors.client" class="invalid-feedback">{{ formErrors.client[0] }}</div>
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
				<div class="form-group col-md-10">
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

				<div class="form-group col-md-2">
					<label for="discount">{{ __('app.common.discount') }}</label>
					<input
						type="number"
						min="0"
						max="99"
						class="form-control"
						id="discount"
						v-model="form.discount"
						:class="{'is-invalid': formErrors.discount}"
					/>
					<div v-if="formErrors.discount" class="invalid-feedback">{{ formErrors.discount[0] }}</div>
				</div>
			</div>

			<button
				class="btn btn-success d-block w-100"
				@click.prevent="createInvoice"
			>{{ __('app.sales.add_invoice') }}</button>
		</form>

		<div v-else class="invoice-info">
			<create-sale-details
				v-if="showCreateDetails"
				@close-modal="showCreateDetails = false"
				@detail-created="getInvoiceDetails"
				:invoice="invoice"
			></create-sale-details>

			<show-sales-details :invoice="invoice" :items="invoiceDetails"></show-sales-details>

			<button
				class="btn btn-primary d-block w-100"
				@click.prevent="showCreateDetails = true"
			>{{ __('app.sales.add_detail') }}</button>
		</div>
	</b-modal>
</template>

<script>
/*
form { client, paymentType,  paymentStatus, note, discount}
*/
export default {
	data() {
		return {
			show: true,
			showCreateDetails: false,
			form: {},
			formErrors: {},
			clients: [],
			invoice: {},
			invoiceDetails: []
		}
	},
	computed: {
		thereIsInvoice() {
			return Object.keys(this.invoice).length !== 0
		},
		discount() {
			return `${this.invoice.discount * 100}%`
		}
	},
	methods: {
		getClients() {
			this.fetchData(`/api/clients`).then(data => {
				this.clients = data
			})
		},
		getInvoiceDetails() {
			this.fetchData(`/api/sales/${this.invoice.id}`).then(data => {
				this.invoiceDetails = data.details
				this.showCreateDetails = false
			})
		},
		createInvoice() {
			this.formErrors = {}
			this.postData(`/api/sales`, this.form).then(res => {
				if (res.status === 'success') {
					this.swalSuccess(res.message)
					this.invoice = res.data
				} else if (res.status === 'error') {
					this.formErrors = res.message
				}
			})
		}

	},
	created() {
		this.getClients()
		eventBus.$on('delete-sale-detail', (index) => {
			this.invoiceDetails.splice(index, 1)
		})
	}
}
</script>

