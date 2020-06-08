<template>
	<b-modal
		@hidden="hideModal"
		size="lg"
		v-model="show"
		:title="__('app.users.user_details', {user: info.username})"
		hide-footer
	>
		<div class="image-user position-absolute">
			<img :src="`/storage/profiles/${info.image}`" alt />
		</div>
		<div class="user-details">
			<table>
				<tr>
					<td>{{ __('app.common.first_name') }}</td>
					<td>{{ info.first_name }}</td>
				</tr>
				<tr>
					<td>{{ __('app.common.last_name') }}</td>
					<td>{{ info.last_name }}</td>
				</tr>
				<tr>
					<td>{{ __('app.common.email') }}</td>
					<td>{{ info.email }}</td>
				</tr>
				<tr>
					<td>{{ __('app.common.address') }}</td>
					<td>{{ info.address }}</td>
				</tr>
				<tr>
					<td>{{ __('app.common.gender') }}</td>
					<td>{{ info.gender }}</td>
				</tr>
				<tr>
					<td>{{ __('app.common.dob') }}</td>
					<td>{{ info.dob }}</td>
				</tr>
				<tr>
					<td>{{ __('app.common.phone') }}</td>
					<td>{{ info.phone }}</td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>{{ __('app.users.created_at') }}</td>
					<td>{{ info.created_at }}</td>
				</tr>
				<tr>
					<td>{{ __('app.users.updated_at') }}</td>
					<td>{{ info.updated_at }}</td>
				</tr>
				<tr>
					<td>{{ __('app.users.last_login') }}</td>
					<td>{{ info.last_login }}</td>
				</tr>
			</table>
		</div>
	</b-modal>
</template>

<script>
export default {
   data() {
      return {
         show: true
      }
   },
	props: {
		info: Object
	}
}
</script>

<style lang="scss">
.image-user {
	left: 10px;
	top: 10px;

	img {
		width: 150px;
		height: 200px;
		object-fit: cover;
	}
}

.user-details {
	table {
		tr {
			td:first-child {
				width: 200px;
				text-align: right; // ltr
				padding: 10px 20px;
			}
		}
	}
}

.rtl {
	.user-details {
		table {
			tr {
				td:first-child {
					text-align: left; // ltr
				}
			}
		}
	}
}
</style>
