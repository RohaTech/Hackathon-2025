import { defineStore } from "pinia";
import router from "@/router";

export const usePayrollStore = defineStore("payrollStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {


    async getPayroll(payroll) {
      const res = await fetch(`/api/payrolls/${payroll}`, {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
      });
      const data = await res.json();
      return data

    },


    async getAllPayrolls() {
      const res = await fetch("/api/payrolls", {
        method: "Get",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
      });
      const data = await res.json();

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};
        return data
      }
    },

    /*********************  Create Package ********************** */
    async createPayroll(formData) {

      const res = await fetch("/api/payrolls", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,

        },
        body: JSON.stringify(formData),
      });
      const data = await res.json();
      console.log(data)

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};



      }
    },


    /*********************  Update Payroll ********************** */
    async updatePayroll(formData, payroll) {

      const res = await fetch(`/api/payrolls/${payroll}`, {
        method: "PUT",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });
      const data = await res.json();
      console.log(data)

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};
      }
    },

    async deletePayroll(payroll) {
      try {
        const res = await fetch(`/api/payrolls/${payroll}`, {
          method: 'delete',
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
        });

        const data = await res.json();

        if (!res.ok) {
          this.errors = data || { message: 'Failed to delete laboratory' };
          return { success: false };
        }

        this.errors = {};
        return { success: true, message: 'Laboratory deleted successfully!' };
      } catch (err) {
        this.errors = { message: err.message || 'An unexpected error occurred' };
        return { success: false };
      }
    },
  },

});
