<template>
	<b-modal
		@ok="submit"
		v-model="show"
		@hidden="hideModal"
		:title="__('app.sales.create')"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
		size="lg"
	>
		<form>
			<div class="form-group">
				<v-select
					:options="products"
					:placeholder="__('app.products.choose')"
					label="name"
					@input="changeProduct"
				>
					<template #option="{ id, name, quantity }">
						<div>
                     {{ id }}: {{ name }} <span class="font-weight-bold" :class="{'text-danger': !quantity}">({{ quantity }})</span>
                  </div>
					</template>
					<div slot="no-options">{{ __('app.products.no_match_product') }}</div>
				</v-select>
			</div>

			<div v-if="product" class="form-group product-info">
				<img v-if="previewImage" style="max-height: 400px;" :src="previewImage" width="100%" alt />
				<table v-if="product.quantity !== 0">
					<tr>
						<td>{{ __('app.common.price') }}</td>
						<td>{{ product.price }}</td>
					</tr>
					<tr>
						<td>{{ __('app.common.discount') }}</td>
						<td>{{ discount }}</td>
					</tr>
					<tr>
						<td>{{ __('app.products.price_discount') }}</td>
						<td>{{ price }}</td>
					</tr>
					<tr>
						<td>{{ __('app.products.category') }}</td>
						<td>{{ product.category.name }}</td>
					</tr>
				</table>
				<div class="stockout" v-else>{{ __('app.products.stockout') }}</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-8">
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

				<div class="form-group col-md-4">
					<label for="store-quantity">{{ __("app.products.store_quantity") }}</label>
					<input
						type="text"
						class="form-control"
						id="store-quantity"
						:value="product ? product.quantity : __('app.products.choose')"
						disabled
					/>
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
			categories: null,
			products: [],
			product: null,
			previewImage: null
		}
	},
	props: {
		invoice: Object
	},
	computed: {
		discount() {
			return `${this.invoice.discount * 100}%`
		},
		price() {
			let p = this.product.price - (this.product.price * this.invoice.discount)
			return Number(p).toFixed(2)
		}
	},
	methods: {
		submit(m) {
			m.preventDefault()
			this.formErrors = {}
			this.form.invoiceId = this.invoice.id
			this.form.price = this.price

			this.postData(`/api/sales/details`, this.form).then(res => {
				if (res.status === 'success') {
					// this.swalSuccess(res.message)
					this.$emit('detail-created')
				} else if (res.status === 'error') {
					this.formErrors = res.message
				}
			})
		},
		changeProduct(val) {
			this.product = val
			this.formErrors = {}
			this.form.product = this.product.id
			this.previewImage = `/storage/products/${this.product.image}`
		},
		getProductsCategories() {
			this.fetchData(`/api/productscategories`).then(data => {
				this.categories = data
			})
		},
		getProducts() {
			this.fetchData(`/api/products`).then(data => {
				this.products = data
			})
		}
	},
	created() {
		// this.getProductsCategories()
		this.getProducts()
	}
}
</script>

<style lang="scss">
.product-info {
	table {
		width: 100%;
		margin: 20px 0;
		tr {
			td {
				padding: 5px 0;
			}
			&:nth-child(odd) {
				background-color: #eee;
			}
		}
	}

	.stockout {
		text-align: center;
		margin: 20px 0;
		border: 1px solid #eee;
		padding: 5px 0;
		background: rgba(255, 0, 0, 0.733);
		color: white;
	}
}
</style>
