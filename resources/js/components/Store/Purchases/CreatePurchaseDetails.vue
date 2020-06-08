<template>
	<b-modal
		@ok="submit"
		v-model="show"
		@hidden="hideModal"
		:title="__('app.purchases.new_product')"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
	>
		<form>
			<div class="form-group">
				<label for="name">{{ __("app.products.name") }}</label>
				<input
					type="text"
					class="form-control"
					id="name"
					v-model="form.name"
					:class="{ 'is-invalid': formErrors.name }"
				/>
				<div v-if="formErrors.name" class="invalid-feedback">{{ formErrors.name[0] }}</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="product-category">{{ __("app.products.category") }}</label>
					<select
						class="form-control"
						id="product-category"
						v-model="form.category"
						:class="{ 'is-invalid': formErrors.category }"
					>
						<option :value="undefined" disabled>{{ __("app.products.select_category_group") }}</option>
						<option
							v-for="category in categories"
							:key="category.id"
							:value="category.id"
						>{{ category.name }}</option>
					</select>
					<div v-if="formErrors.category" class="invalid-feedback">{{ formErrors.category[0] }}</div>
				</div>

				<div class="form-group col-md-6">
					<label for="quantity">{{ __("app.common.quantity") }}</label>
					<input
						type="number"
						class="form-control"
						id="quantity"
						v-model="form.quantity"
						:class="{'is-invalid': formErrors.quantity}"
					/>
					<div class="invalid-feedback" v-if="formErrors.quantity">{{ formErrors.quantity[0] }}</div>
				</div>
			</div>

			<div class="form-group">
				<label for="image">{{ __("app.common.image") }}</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="image" @change="onFileChange" />
					<label
						class="custom-file-label text-left"
						for="image"
						:class="{ 'is-invalid': formErrors.image }"
					>{{ __("app.products.image") }}</label>
					<div class="invalid-feedback" v-if="formErrors.image">{{ formErrors.image[0] }}</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="purchase-price">{{ __("app.common.purchase_price") }}</label>
					<input
						type="number"
						min="0.00"
						max="100000"
						step="0.01"
						placeholder="0.00"
						class="form-control"
						id="purchase-price"
						v-model="form.purchasePrice"
						:class="{'is-invalid': formErrors.purchasePrice}"
					/>
					<div class="invalid-feedback" v-if="formErrors.purchasePrice">{{ formErrors.purchasePrice[0] }}</div>
				</div>

				<div class="form-group col-md-6">
					<label for="sale-price">{{ __("app.common.sale_price") }}</label>
					<input
						type="number"
						min="0.00"
						max="100000"
						step="0.01"
						placeholder="0.00"
						class="form-control"
						id="sale-price"
						v-model="form.salePrice"
						:class="{'is-invalid': formErrors.salePrice}"
					/>
					<div class="invalid-feedback" v-if="formErrors.salePrice">{{ formErrors.salePrice[0] }}</div>
				</div>
			</div>
		</form>
	</b-modal>
</template>

<script>
export default {
	data() {
		return {
			show: true,
			form: {},
			formErrors: {},
			categories: null
		}
	},
	props: {
		invoice: Object
	},
	methods: {
		onFileChange(e) {
			this.form.image = e.target.files[0]
		},
		submit(m) {
			m.preventDefault()
			this.formErrors = {}
			this.form.invoiceId = this.invoice.id

			this.postData('/api/purchases/details', this.form).then(res => {
				if (res.status === 'success') {
					// this.swalSuccess(res.message)
					this.$emit('detail-created')
				} else if (res.status === 'error') {
					this.formErrors = res.message
				}
			})
		},
		getProductsCategories() {
         this.fetchData(`/api/productscategories`).then(data => {
				this.categories = data
         })
		}
	},
	created() {
		this.getProductsCategories()
	}
}
</script>

<style>
</style>
