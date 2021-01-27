<template>
	<b-modal
		@ok="submit"
		@hidden="hideModal"
		v-model="show"
		:title="__('app.suppliers.create')"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
      :ok-disabled="submitLoading"
	>
      <template #modal-ok>
         Create
         <div v-if="submitLoading" class="spinner-border spinner-border-sm" role="status"></div>
      </template>

		<form>
			<div class="form-group">
				<label for="name">{{ __('app.common.name') }}</label>
				<input
					v-model="form.name"
					type="text"
					class="form-control"
					:class="{ 'is-invalid': formErrors.name }"
					id="name"
				/>
				<div v-if="formErrors.name" class="invalid-feedback">{{ formErrors.name[0] }}</div>
			</div>

			<div class="form-group">
				<label for="email">{{ __('app.common.email') }}</label>
				<input
					v-model="form.email"
					type="email"
					class="form-control"
					:class="{ 'is-invalid': formErrors.email }"
					id="email"
				/>
				<div v-if="formErrors.email" class="invalid-feedback">{{ formErrors.email[0] }}</div>
			</div>

			<div class="form-group">
				<label for="phone">{{ __('app.common.phone') }}</label>
				<input
					v-model="form.phone"
					type="text"
					class="form-control"
					:class="{ 'is-invalid': formErrors.phone }"
					id="phone"
				/>
				<div v-if="formErrors.phone" class="invalid-feedback">{{ formErrors.phone[0] }}</div>
			</div>

			<div class="form-group">
				<label for="address">{{ __('app.common.address') }}</label>
				<input
					v-model="form.address"
					type="text"
					class="form-control"
					:class="{ 'is-invalid': formErrors.address }"
					id="address"
				/>
				<div v-if="formErrors.address" class="invalid-feedback">{{ formErrors.address[0] }}</div>
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
			formErrors: {}
		}
	},
	methods: {
		submit(m) {
            m.preventDefault()
            this.formErrors = {}
            this.postData('/api/suppliers', this.form).then(res => {
                if(res.status === 'success') {
                this.swalSuccess(res.message)
                this.$emit('succeed')
                } else if (res.status === 'error') {
                    this.formErrors = res.message
                }
            })
		}
	}
}
</script>

<style>
</style>
