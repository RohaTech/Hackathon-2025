// src/stores/doctor.js
import { defineStore } from "pinia";
import { ref } from "vue";

export const useEmployeeStore = defineStore("employeeStore", {
  state: () => ({
    employees: [],
    errors: null,
  }),
  actions: {
    async getEmployees() {
      try {
        const response = await fetch("/api/employees", {
          method: "GET",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
        });

        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        this.employees = data;
        return this.employees;
      } catch (error) {
        console.error("Error fetching employees:", error);
        return [];
      }
    },

    async addEmployee(employeeData) {
      try {
        const response = await fetch("/api/employees", {
          method: "POST",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
          body: JSON.stringify(employeeData),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        this.employees = data;
        return this.employees;
      } catch (error) {
        console.error("Error fetching active employees:", error);
        return [];
      }
    },

    async updateEmployee(employee_id, employeeData) {
      try {
        const response = await fetch(`/api/employees/${employee_id}`, {
          method: "PUT",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
          body: JSON.stringify(employeeData),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        this.employees = data;
        return this.employees;
      } catch (error) {
        console.error("Error fetching active employees:", error);
        return [];
      }
    },
    async deleteEmployee(employee_id) {
      try {
        const response = await fetch(`/api/employees/${employee_id}`, {
          method: "DELETE",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
        });

        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        this.employees = data;
        return this.employees;
      } catch (error) {
        console.error("Error fetching active employees:", error);
        return [];
      }
    },
  },
});