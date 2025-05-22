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

const calculateTotals = (data) => {
  const totals = {
    name: "TOTAL",
    employement_date: "",
  };

  // Initialize all numeric fields to 0
  data.forEach((item) => {
    for (const key in item) {
      if (typeof item[key] === "number" && !totals.hasOwnProperty(key)) {
        totals[key] = 0;
      }
    }
  });

  // Sum up all numeric values
  data.forEach((item) => {
    for (const key in item) {
      if (typeof item[key] === "number") {
        totals[key] += item[key];
      }
    }
  });

  return totals;
};

onMounted(async () => {
  payrolls.value = await getAllPayrolls();
  console.log(filteredPayrolls.value);

  filteredPayrolls.value.forEach((item) => {
    const excelItem = {
      name: item.employee.name,
      employement_date: item.employee.employement_date,
      basic_salary: item.employee.basic_salary,
      working_days: item.working_days,
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
    };

    // Dynamically add allowances to the excel item
    item.allowances.forEach((allowance) => {
      excelItem[`allowance_${allowance.allowances_name}`] =
        allowance.non_taxable;
    });

    dataExcel.value.push(excelItem);
  });

  // Add totals row
  if (dataExcel.value.length > 0) {
    dataExcel.value.push(calculateTotals(dataExcel.value));
  }
});

const excelFields = computed(() => {
  const fields = {
    "Employee Name": "name",
    "Employment Date": "employement_date",
    "Basic Salary": "basic_salary",
    "Working Days": "working_days",
    "Earned Salary": "earned_salary",
    other_commissions: "other_commissions",
    gross_pay: "gross_pay",
    taxable_income: "taxable_income",
    income_tax: "income_tax",
    employee_pension: "employee_pension",
    employer_pension: "employer_pension",
    total_pension: "total_pension",
    loan_or_penality: "loan_or_penality",
    total_deductions: "total_deductions",
    net_pay: "net_pay",
  };

  // Dynamically add allowance fields
  allowanceColumns.value.forEach((allowanceName) => {
    fields[`Allowance: ${allowanceName}`] = `allowance_${allowanceName}`;
  });

  return fields;
});

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
