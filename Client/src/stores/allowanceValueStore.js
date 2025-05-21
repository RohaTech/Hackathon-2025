import { defineStore } from "pinia";
import router from "@/router";

export const useAllowanceValueStore = defineStore("allowanceValueStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {


    async getAllowanceValue(allowanceValue) {
      const res = await fetch(`/api/allowancesvalue/${allowanceValue}`, {
        method: 'GET',
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
      });
      const data = await res.json();
      return data

    },


    async getAllAllowanceValues() {
      const res = await fetch("/api/allowancesvalue", {
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
    async createAllowanceValue(formData) {

      const res = await fetch("/api/allowancesvalue", {
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


    /*********************  Update AllowanceValue ********************** */
    async updateAllowanceValue(formData, allowanceValue) {

      const res = await fetch(`/api/allowancesvalue/${allowanceValue}`, {
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

    async deleteAllowanceValue(allowanceValue) {
      try {
        const res = await fetch(`/api/allowancesvalue/${allowanceValue}`, {
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
