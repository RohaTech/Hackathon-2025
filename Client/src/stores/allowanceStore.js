import { defineStore } from "pinia";
import router from "@/router";

export const useAllowanceStore = defineStore("allowanceStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {


    async getAllowance(allowance) {
      const res = await fetch(`/api/allowances/${allowance}`, {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
      });
      const data = await res.json();
      return data

    },


    async getAllAllowances() {
      const res = await fetch("/api/allowances", {
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
    async createAllowance(formData) {

      const res = await fetch("/api/allowances", {
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


    /*********************  Update Allowance ********************** */
    async updateAllowance(formData, allowance) {

      const res = await fetch(`/api/allowances/${allowance}`, {
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

    async deleteAllowance(allowance) {
      try {
        const res = await fetch(`/api/allowances/${allowance}`, {
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
