<template>
	<b-modal
		@ok="submit"
		@hidden="hideModal"
		v-model="show"
		:title="__('app.groups.edit')"
		:ok-title="__('app.common.save')"
		:cancel-title="__('app.common.close')"
	>
		<!-- <div v-for="i in group.privileges">test</div> -->
		<form>
			<div v-for="(array, name, index) in privileges" v-bind:key="index" class="form-group privilege">
				<label
					class="d-block privilege-title"
					for
				>{{ __(`app.privileges.${name}`) ? __(`app.privileges.${name}`) : name }}</label>

				<label class="mx-4" :class="item.privilege" for v-for="item in array" v-bind:key="item.id">
					<input v-model="selected[item.id]" type="checkbox" />
					{{ __(`app.privileges.${item.privilege}`) ? __(`app.privileges.${item.privilege}`) : item.privilege }}
				</label>
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
			privileges: null,
			selected: [],
			form: {}
		}
	},
	props: {
		group: Object
	},
	methods: {
		submit(m) {
			m.preventDefault()

			let allPrivileges = []
			for (const key in this.selected) {
				if (this.selected[key] === true) {
					allPrivileges.push(key)
				}
			}

			this.form = {
				group: this.group.id,
				privileges: allPrivileges
			}

			this.postData('/api/privileges', this.form).then(res => {
				if(res.status === 'success') {
               this.swalSuccess(res.message)
               this.$emit('succeed')
            }

			})
		},
		getPrivileges() {
			this.fetchData('/api/privileges').then(data => {
				this.privileges = data

			})
		}
	},
	created() {
		this.getPrivileges()
		this.group.privileges.forEach(element => {
			this.selected[element] = true
		})
	}
}
</script>

<style lang="scss">

.privilege {
	background-color: #eaeaea;
	padding: 12px;
	text-align: center;

   .privilege-title {
      font-weight: bold;
   }

   .show {
      color: rgb(194, 161, 13);
   }

   .create {
      color: green;
   }

   .update {
      color: blue;
   }

   .delete {
      color: red;
   }
}
</style>
