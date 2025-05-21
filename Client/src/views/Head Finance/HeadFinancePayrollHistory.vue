<script setup>
import HeadFinanceLayout from "@/layout/HeadFinanceLayout.vue";
import { useEmployeeStore } from "@/stores/employee";

const { getEmployees } = useEmployeeStore();
// const employees

onMounted(async () => {
  getEmployees;
});

const excelFields = {
  Name: "name",
  Username: "userName",
  Date_of_birth: "birthDay",
  Phone_number: "phoneNumber",
  Address: "address",
  Facebook_address: "facebook",
};

const dataExcel = [
  {
    name: "Phạm Thế Chiêm",
    userName: "chiempt",
    birthDay: "27/09/1999",
    phoneNumber: "0345361887",
    address: "Hoài Đức - Hà Nội",
    facebook: "https://www.facebook.com/chiem.dieu.18/",
  },
];
</script>

<template>
  <HeadFinanceLayout>
    <p class="">HeadFinancePayrollHistory</p>

    <export-excel
      :data="dataExcel"
      :fields="excelFields"
      :title="'Employee Salary Sheet For Ginbot'"
      :name="`employee_payroll_for_ginbot.xls`"
    >
      <button
        class="flex mt-10 items-center w-fit justify-center rounded-lg bg-[#0a5098] px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-[#f3a21b]"
      >
        Download Excel
      </button>
    </export-excel>
  </HeadFinanceLayout>
</template>
