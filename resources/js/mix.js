export default {
   data() {
      return {
         testMix: process.env,
         submitLoading: false,
      };
   },
   methods: {
      __(key, replace) {
         return window.lang(key, replace)
      },
      toFixed(number, fix = 2) {
         return Number(number).toFixed(fix);
      },
      hideModal() {
         this.$emit("close-modal");
      },
      swalFailed(message) {
         Swal.fire({
            icon: "error",
            title: this.__("app.common.fails"),
            text: message,
            position: "top",
            confirmButtonText: this.__("app.common.ok")
         });
      },
      swalSuccess(message) {
         Swal.fire({
            position: "center",
            icon: "success",
            title: message,
            position: "top",
            showConfirmButton: true,
            confirmButtonText: this.__("app.common.ok")
         });
      },
      postData(url, form) {
         let formData = new FormData();

         for (const [field, value] of Object.entries(form)) {
            formData.append(field, value);
         }

         this.submitLoading = true
         return axios
            .post(url, formData, {
               headers: {
                  "content-type": "multipart/form-data"
               }
            })
            .then(res => {
               return res.data;
            })
            .catch(err => {
               this.swalFailed(this.__("app.msg.post_failed"));
            })
            .finally(() => {
               this.submitLoading = false
            })
      },
      updateData(url, form) {
         let formData = new FormData();

         formData.append("_method", "put");
         for (const [field, value] of Object.entries(form)) {
            formData.append(field, value);
         }

         this.submitLoading = true
         return axios
            .post(url, formData, {
               headers: {
                  "content-type": "multipart/form-data"
               }
            })
            .then(res => {
               return res.data;
            })
            .catch(err => {
               this.swalFailed(this.__("app.msg.post_failed"));
            })
            .finally(() => {
               this.submitLoading = false
            })
      },
      fetchData(url) {
         return axios
            .get(url)
            .then(res => {
               return res.data;
            })
            .catch(err => {
               this.swalFailed(this.__("app.msg.fetch_failed"));
            });
      },
      deleteData(url) {
         return Swal.fire({
            title: this.__("app.common.are_you_sure"),
            icon: "warning",
            position: "top",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: this.__("app.common.confirm"),
            cancelButtonText: this.__("app.common.cancel")
         }).then(result => {
            if (result.value) {
               return axios
                  .delete(url)
                  .then(res => {
                     let data = res.data;
                     if (data.status === "success") {
                        this.swalSuccess(data.message);
                     } else if (data.status === "error") {
                        this.swalFailed(data.message);
                     }
                     return "deleted";
                  })
                  .catch(err => {
                     this.swalFailed("error");
                  });
            }
         });
      },
      price(price) {
         return `${Number(this.toFixed(price)).toLocaleString()}${window._currency}`
      }
   }
};
