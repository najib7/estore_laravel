<template>
	<b-modal
		@ok="submit"
		@hidden="hideModal"
		v-model="show"
		:title="__('app.groups.edit')"
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
				<label for="name">{{ __('app.groups.name') }}</label>
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
				<label for="description">{{ __('app.groups.description') }}</label>
				<textarea
					v-model="form.description"
					class="form-control"
					:class="{ 'is-invalid': formErrors.description }"
					id="description"
					rows="4"
				></textarea>
				<div v-if="formErrors.description" class="invalid-feedback">{{ formErrors.description[0] }}</div>
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
	props: {
		group: Object
	},
	methods: {
		submit(m) {
         m.preventDefault()
         this.formErrors = {}
         this.updateData(`/api/groups/${this.group.id}`, this.form).then(res => {
            if (res.status === 'success') {
               this.swalSuccess(res.message)
               this.$emit('succeed')
				} else if (res.status === 'error') {
					this.formErrors = res.message
				}
         })
		}
   },
   created() {
      this.form = {
         name: this.group.name,
         description: this.group.description
      }
   }
}
</script>

<style>
</style>
