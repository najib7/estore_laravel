<template>
	<b-modal
		@ok="submit"
		@hidden="hideModal"
		size="lg"
		v-model="show"
		:title="__('app.users.edit', {user: user.username})"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
      :ok-disabled="submitLoading"
	>
      <template #modal-ok>
         Edit
         <div v-if="submitLoading" class="spinner-border spinner-border-sm" role="status"></div>
      </template>

		<form>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="username">{{ __('app.common.username') }}</label>
					<input
						v-model="form.username"
						type="text"
						class="form-control"
						:class="{ 'is-invalid': formErrors.username }"
						id="username"
					/>
					<div v-if="formErrors.username" class="invalid-feedback">{{ formErrors.username[0] }}</div>
				</div>

				<div class="form-group col-md-6">
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
			</div>

			<div class="form-row">
				<div class="form-group col-md-5">
					<label for="first_name">{{ __('app.common.first_name') }}</label>
					<input
						v-model="form.first_name"
						type="text"
						class="form-control"
						:class="{ 'is-invalid': formErrors.first_name }"
						id="first_name"
					/>
					<div v-if="formErrors.first_name" class="invalid-feedback">{{ formErrors.first_name[0] }}</div>
				</div>

				<div class="form-group col-md-5">
					<label for="last_name">{{ __('app.common.last_name') }}</label>
					<input
						v-model="form.last_name"
						type="text"
						class="form-control"
						:class="{ 'is-invalid': formErrors.last_name }"
						id="last_name"
					/>
					<div v-if="formErrors.last_name" class="invalid-feedback">{{ formErrors.last_name[0] }}</div>
				</div>

				<div class="form-group col-md-2">
					<label for="gender">{{ __('app.common.gender') }}</label>
					<select
						v-model="form.gender"
						id="gender"
						class="form-control"
						:class="{ 'is-invalid': formErrors.gender }"
					>
						<option selected>{{ __('app.common.choose') }}...</option>
						<option value="male">{{ __('app.common.male') }}</option>
						<option value="female">{{ __('app.common.female') }}</option>
					</select>
					<div v-if="formErrors.gender" class="invalid-feedback">{{ formErrors.gender[0] }}</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-8">
					<label for="address">{{ __('app.common.address') }}</label>
					<input
						v-model="form.address"
						:placeholder="__('app.common.address')"
						type="text"
						class="form-control"
						:class="{ 'is-invalid': formErrors.address }"
						id="address"
					/>
					<div v-if="formErrors.address" class="invalid-feedback">{{ formErrors.address[0] }}</div>
				</div>

				<div class="form-group col-md-4">
					<label for="dob">{{ __('app.common.dob') }}</label>
					<input
						v-model="form.dob"
						type="date"
						id="dob"
						class="form-control"
						:class="{ 'is-invalid': formErrors.dob }"
					/>
					<div v-if="formErrors.dob" class="invalid-feedback">{{ formErrors.dob[0] }}</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="image">{{ __('app.common.image') }}</label>
					<div class="custom-file">
						<input @change="onFileChange" type="file" class="custom-file-input" id="image" />
						<label
							class="custom-file-label text-left"
							:class="{ 'is-invalid': formErrors.image }"
							for="image"
						>{{ __('app.common.choose_image') }}...</label>
						<div v-if="formErrors.image" class="invalid-feedback">{{ formErrors.image[0] }}</div>
					</div>
				</div>

            <div class="form-group col-md-3">
					<label for="group">{{ __("app.common.group") }}</label>
					<select
						class="form-control"
						id="group"
						v-model="form.group"
						:class="{ 'is-invalid': formErrors.group }"
					>
						<option :value="undefined" disabled>{{ __("app.groups.select_group") }}</option>
						<option
							v-for="group in groups"
							:key="group.id"
							:value="group.id"
						>{{ group.name }}</option>
					</select>
					<div v-if="formErrors.group" class="invalid-feedback">{{ formErrors.group[0] }}</div>
				</div>

				<div class="form-group col-md-3">
					<label for="phone">{{ __('app.common.phone') }}</label>
					<input
						v-model="form.phone"
						type="text"
						id="phone"
						class="form-control"
						:class="{ 'is-invalid': formErrors.phone }"
					/>
					<div v-if="formErrors.phone" class="invalid-feedback">{{ formErrors.phone[0] }}</div>
				</div>
			</div>
		</form>

		<div class="preview-image">
			<img v-if="previewImage" :src="previewImage" alt />
		</div>
	</b-modal>
</template>

<script>
export default {
	data() {
		return {
         show: true,
			form: {},
			formErrors: {},
         previewImage: null,
         groups: []
		}
	},
	props: {
		user: Object
	},
	methods: {
		onFileChange(e) {
			this.form.image = e.target.files[0]
			this.previewImage = URL.createObjectURL(this.form.image)
		},
		submit(m) {
         m.preventDefault()
         this.formErrors = {}
         this.updateData(`/api/users/${this.user.id}`, this.form).then(res => {
            if(res.status === 'success') {
               this.swalSuccess(res.message)
					this.$emit('succeed')
            } else if (res.status === 'error') {
               this.formErrors = res.message
            }
         })
      },
      getGroups() {
         this.fetchData('/api/groups').then(data => {
            this.groups = data
         })
      }
	},
	created() {
      this.previewImage = `/storage/profiles/${this.user.image}`
      this.getGroups()
		this.form = {
			username: this.user.username,
			email: this.user.email,
			first_name: this.user.first_name,
			last_name: this.user.last_name,
			gender: this.user.gender,
			address: this.user.address,
			dob: this.user.dob,
         phone: this.user.phone,
         group: this.user.group_id
		}
	}
}
</script>

<style lang="scss">
.preview-image {
	text-align: center;
	max-width: 200px;
	height: 250px;
	margin: auto;
	object-fit: cover;

	img {
		width: 100%;
		height: 100%;
	}
}
</style>
