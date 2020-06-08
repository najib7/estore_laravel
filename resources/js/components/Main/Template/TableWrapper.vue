<script>
export default {
	props: {
		items: Array,
		fields: Array
	},
	render(h) {
		for (let [key, value] of Object.entries(this.$scopedSlots)) {
			this.$parent.$scopedSlots[key] = value
		}

		return h('b-table', {
			props: Object.assign(this.$attrs, this.$props),
			slots: this.$parent.$slots,
			scopedSlots: this.$parent.$scopedSlots
		})
	}
}
</script>
