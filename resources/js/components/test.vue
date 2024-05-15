<template lang="">
    <div></div>
</template>
<script>
export default {
    data() {
        return {
            editMode: false,
            modal: "",
            departmentData: {
                id: "",
                name: "",
                director_id: 0,
            },
            // departments: {},
            // object error
            departmentErrors: {},
        };
    },
    mounted() {
        this.modal = new Modal(document.getElementById("exampleModal"));
        this.getDepartments();
    },
    computed: {
        // department list
        departments() {
            return this.$store.getters["department/getDepartments"];
        },
    },
    methods: {
        openModal() {
            this.editMode = false;
            this.departmentData.name = this.departmentData.director_id = "";
            this.modal.show();
        },

        closeModal() {
            this.modal.hide();
        },
        // save Department method
        saveDepartment() {
            console.log("name : " + typeof this.departmentData.name);
            console.log("director : " + typeof this.departmentData.director_id);
            if (this.validateData()) {
                // axios
                //     .post("departments", this.departmentData)
                //     .then((response) => {
                //         console.log(response);
                //         this.closeModal();
                //     });
                this.$store.dispatch({
                    type: "department/storeDepartment",
                    data: this.departmentData,
                });
                this.closeModal();
            }
        },
        // get departments list
        getDepartments() {
            // axios
            //     .get("departments")
            //     .then((response) => {
            //         this.departments = response.data;
            //         console.log(this.departments);
            //     })
            //     .catch((error) => {
            //         console.error("Error fetching departments:", error);
            //     });
            this.$store.dispatch("department/departmentsList");
        },
        // show edit department modal
        editDepartment(department) {
            this.editMode = true;
            this.departmentData.id = department.id;
            this.departmentData.name = department.name;
            this.departmentData.director_id = department.director_id;
            this.modal.show();
        },
        // update department
        updateDepartment() {
            if (this.validateData()) {
                // axios
                //     .put(
                //         `departments/${this.departmentData.id}`,
                //         this.departmentData
                //     )
                //     .then((response) => {
                //         console.log(
                //             "department updated successfully:",
                //             response.data
                //         );
                //         this.getDepartments();
                //         this.closeModal();
                //     })
                //     .catch((error) => {
                //         console.error("Error updating department:", error);
                //     });

                this.$store.dispatch({
                    type: "department/updateDepartment",
                    department: this.departmentData,
                });
            }
        },
        // delete Department
        deleteDepartment(department) {
            if (confirm("Are you sure you want to delete department!")) {
                // axios
                //     .delete("departments/" + department.id)
                //     .then(() => {
                //         this.getDepartments();
                //     })
                //     .catch((error) => {
                //         console.error("Error deleting department:", error);
                //     });
                this.$store.dispatch({
                    type: "department/deleteDepartment",
                    department: this.departmentData,
                });
            }
        },
        // validate Name
        validateName() {
            if (!this.departmentData.name) {
                this.departmentErrors.name = "Name is required";
            } else {
                delete this.departmentErrors.name;
            }
        },
        // validate Director Id
        validateDirector() {
            console.log(typeof this.departmentData.director_id);
            if (!this.departmentData.director_id) {
                this.departmentErrors.director_id = "director is required";
            } else {
                delete this.departmentErrors.director_id;
            }
        },
        // validate data methode
        validateData() {
            this.validateName();
            this.validateDirector();
            return Object.keys(this.departmentErrors).length === 0;
        },
    },
};
</script>
<style lang=""></style>
