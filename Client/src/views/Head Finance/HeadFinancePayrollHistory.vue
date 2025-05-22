<script setup>
import HeadFinanceLayout from "@/layout/HeadFinanceLayout.vue";
import { useAuthStore } from "@/stores/auth";
import { useEmployeeStore } from "@/stores/employee";
import { onMounted, ref } from "vue";
import { usePayrollStore } from "@/stores/payrollStore";

const { getEmployees } = useEmployeeStore();
const { getAllPayrolls } = usePayrollStore();

const authStore = useAuthStore();
const employees = ref([]);
const dataExcel = ref([]);

onMounted(async () => {
  employees.value = await getEmployees();
  console.log(employees.value);

  employees.value.forEach((employee) => {
    dataExcel.value.push({
      name: employee.name,
      email: employee.email,
      position: employee.position,
      employement_type: employee.employement_type,
      basic_salary: employee.basic_salary,
      account_number: employee.account.account_number,
    });
  });
});

const excelFields = {
  Name: "name",
  Email: "email",
  Position: "position",
  "Employment Type": "employement_type",
  Salary: "basic_salary",
  "Account Number": "account_number",
};

const test = () => {
  console.log(dataExcel.value);
};
</script>

<template>
  <HeadFinanceLayout>
    <p class="">HeadFinancePayrollHistory</p>

    <export-excel
      :data="dataExcel"
      :fields="excelFields"
      :title="'Employee Salary Sheet For Ginbot'"
      :footer="
        'Prepared By' +
        '_______________________  approved by ' +
        authStore?.user.name +
        '______________________  '
      "
      :name="`employee_payroll_for_february.xls`"
    >
      <button
        class="flex mt-10 items-center w-fit justify-center rounded-lg bg-[#0a5098] px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-[#f3a21b]"
      >
        Download Excel
      </button>
    </export-excel>
    <button
      @click="test"
      class="flex mt-10 items-center w-fit justify-center rounded-lg bg-[#0a5098] px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-[#f3a21b]"
    >
      Test Excel
    </button>
  </HeadFinanceLayout>
</template>
