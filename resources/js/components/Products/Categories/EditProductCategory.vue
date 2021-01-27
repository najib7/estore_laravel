<template>
	<b-modal
		@ok="submit"
		@hidden="hideModal"
		v-model="show"
		:title="__('app.products_categories.edit', {category: category.name})"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
      :ok-disabled="submitLoading"
	>
      <template #modal-ok>
         Edit
         <div v-if="submitLoading" class="spinner-border spinner-border-sm" role="status"></div>
      </template>

		<form>
			<div class="form-group">
				<label for="name">{{ __("app.common.name") }}</label>
				<input
					v-model="form.name"
					type="text"
					class="form-control"
					id="name"
					:class="{ 'is-invalid': formErrors.name }"
				/>
				<div v-if="formErrors.name" class="invalid-feedback">{{ formErrors.name[0] }}</div>
			</div>

			<div class="form-group">
				<label for="description">{{ __('app.products_categories.description') }}</label>
				<textarea
					v-model="form.description"
					class="form-control"
					id="description"
					rows="3"
					required
					:class="{'is-invalid': formErrors.description}"
				></textarea>
				<div v-if="formErrors.description" class="invalid-feedback">{{ formErrors.description[0] }}</div>
			</div>

			<div class="form-group">
				<label for="image">{{ __("app.common.image") }}</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="image" @change="onFileChange" />
					<label
						class="custom-file-label text-left"
						for="image"
						:class="{ 'is-invalid': formErrors.image }"
					>{{ __("app.common.image") }}</label>
					<div class="invalid-feedback" v-if="formErrors.image">{{ formErrors.image[0] }}</div>
				</div>

				<img
					v-if="previewImage"
					:src="previewImage"
					class="d-block mx-auto mt-4"
					height="300"
					width="300"
					alt
				/>
			</div>
		</form>
	</b-modal>
</template>

<script>
export default {
	data() {
		return {
         show: true,
         previewImage: null,
         form: {},
			formErrors: {}
		}
	},
	props: {
		category: Object
	},
	methods: {
      hideModal() {
         this.$emit('close-modal')
      },
		onFileChange(e) {
			this.form.image = e.target.files[0]
			this.previewImage = URL.createObjectURL(this.form.image)
		},
		submit(m) {
         m.preventDefault()
         this.formErrors = {}
         this.updateData(`/api/productscategories/${this.category.id}`, this.form).then(res => {
            if(res.status === 'success') {
               this.swalSuccess(res.message)
					this.$emit('succeed')
            } else if(res.status === 'error') {
               this.formErrors = res.message
            }
         })
		}
	},
	created() {
      this.previewImage = `/storage/p_category/${this.category.image}`
      this.form = {
         name: this.category.name,
         description: this.category.description
      }
	}
}
</script>

<style>
</style>
