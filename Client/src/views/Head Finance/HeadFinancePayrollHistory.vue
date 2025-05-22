<script setup>
import HeadFinanceLayout from "@/layout/HeadFinanceLayout.vue";
import { useAuthStore } from "@/stores/auth";
import { useEmployeeStore } from "@/stores/employee";
import { computed, onMounted, ref } from "vue";
import { usePayrollStore } from "@/stores/payrollStore";

const { getEmployees } = useEmployeeStore();
const { getAllPayrolls } = usePayrollStore();

const authStore = useAuthStore();
const employees = ref([]);
const payrolls = ref([]);
const dataExcel = ref([]);

const currentMonth = new Date().toLocaleString("default", { month: "long" });

const parsedPayrolls = computed(() =>
  payrolls.value.map((item) => ({
    ...item,
    allowances: item.allowances ? JSON.parse(item.allowances) : [],
  }))
);

const filteredPayrolls = computed(() => {
  return parsedPayrolls.value.filter((p) => p.month === currentMonth);
});

const allowanceColumns = computed(() => {
  const names = new Set();
  parsedPayrolls.value.forEach((item) => {
    item.allowances.forEach((a) => names.add(a.allowances_name));
  });
  return Array.from(names);
});

const excelFields = computed(() => ({
  "Employee Name": "name",
  "Employment Date": "employement_date",
  "Basic Salary": "basic_salary",
  "Working Days": "working_days",
  "Earned Salary": "earned_salary",
  ...allowanceColumns.value.reduce((acc, name) => {
    acc[name] = name;
    return acc;
  }, {}),
  "Other Commissions": "other_commissions",
  "Gross Pay": "gross_pay",
  "Taxable Income": "taxable_income",
  "Income Tax": "income_tax",
  "Employee Pension": "employee_pension",
  "Employer Pension": "employer_pension",
  "Total Pension": "total_pension",
  "Loan or Penalty": "loan_or_penality",
  "Total Deductions": "total_deductions",
  "Net Pay": "net_pay",
}));

onMounted(async () => {
  payrolls.value = await getAllPayrolls();
  console.log("Filtered Payrolls:", filteredPayrolls.value);

  dataExcel.value = filteredPayrolls.value.map((item) => ({
    name: item.employee.name,
    employement_date: item.employee.employement_date,
    basic_salary: item.employee.basic_salary,
    working_days: item.working_days,
    ...item.allowances.reduce((acc, a) => {
      acc[a.allowances_name] = a.amount;
      return acc;
    }, {}),
    earned_salary: item.earned_salary,
    other_commissions: item.other_commissions,
    gross_pay: item.gross_pay,
    taxable_income: item.taxable_income,
    income_tax: item.income_tax,
    employee_pension: item.employee_pension,
    employer_pension: item.employer_pension,
    total_pension: item.employer_pension + item.employee_pension,
    loan_or_penality: item.loan_or_penality,
    total_deductions: item.total_deductions,
    net_pay: item.net_pay,
  }));

  console.log("Data Excel:", dataExcel.value);
  console.log("Excel Fields:", excelFields.value);
});

const test = () => {
  console.log("Data Excel:", dataExcel.value);
  console.log("Excel Fields:", excelFields.value);
};
</script>

<template>
  <HeadFinanceLayout>
    <p>HeadFinancePayrollHistory</p>

    <export-excel
      :data="dataExcel"
      :fields="excelFields"
      :title="'Employee Salary Sheet For ' + currentMonth"
      :footer="
        'Prepared By Nahom Abraham  ' +
        '_______________________  approved by ' +
        authStore?.user.name +
        '______________________  '
      "
      :name="`employee_payroll_for_` + currentMonth + '.xls'"
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
