<template>
	<b-modal
		@ok="submit"
		@hidden="hideModal"
		v-model="show"
		:title="__('app.products.create')"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
	>
		<form>
			<div class="form-group">
				<label for="name">{{ __("app.common.name") }}</label>
				<input
					type="text"
					class="form-control"
					id="name"
					v-model="form.name"
					:class="{ 'is-invalid': formErrors.name }"
				/>
				<div v-if="formErrors.name" class="invalid-feedback">{{ formErrors.name[0] }}</div>
			</div>

			<div class="form-group">
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

				<img
					v-if="previewImageUrl"
					:src="previewImageUrl"
					class="d-block mx-auto mt-4"
					height="300"
					width="300"
					alt
				/>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="price">{{ __("app.common.price") }}</label>
					<input
						type="number"
						min="0.00"
						max="100000"
						step="0.01"
						placeholder="0.00"
						class="form-control"
						id="price"
						v-model="form.price"
						:class="{'is-invalid': formErrors.price}"
					/>
					<div class="invalid-feedback" v-if="formErrors.price">{{ formErrors.price[0] }}</div>
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
		</form>
	</b-modal>
</template>

<script>
export default {
	data() {
		return {
			show: true,
			form: {},
			categories: [],
			formErrors: {},
			previewImageUrl: null
		}
	},
	methods: {
		hideModal() {
			this.$emit('close-modal')
		},
		submit(m) {
			m.preventDefault()
			this.postData(`/api/products`, this.form).then(res => {
				if (res.status === 'success') {
               this.swalSuccess(res.message)
					this.$emit("succeed")
				} else if (res.status === 'error') {
					this.formErrors = res.message
				}
			})
		},
		onFileChange(e) {
			this.form.image = e.target.files[0]
			this.previewImageUrl = URL.createObjectURL(this.form.image)
		},
		getProductsCategories() {
         this.fetchData(`/api/productscategories`).then(res => {
            this.categories = res
         })
		},
	},
	created() {
		this.getProductsCategories()
	}
}
</script>

<style>
</style>
