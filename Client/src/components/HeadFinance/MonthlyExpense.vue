<script setup>
import { ref, onMounted, computed } from "vue";
import VueApexCharts from "vue3-apexcharts";
import { useEmployeeStore } from "@/stores/employee";
import { usePayrollStore } from "@/stores/payrollStore";

const { getEmployees } = useEmployeeStore();
const { getAllPayrolls } = usePayrollStore();

const payrolls = ref([]);

onMounted(async () => {
  payrolls.value = await getAllPayrolls();
});

// Process payroll data to get monthly sums
const monthlyData = computed(() => {
  const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];

  // Initialize data structure for all months
  const data = months.map((month) => ({
    month,
    netPay: 0,
    employerPension: 0,
    totalDeductions: 0,
  }));

  // Process each payroll record
  payrolls.value.forEach((payroll) => {
    const monthIndex = months.findIndex((m) => m === payroll.month);
    if (monthIndex !== -1) {
      data[monthIndex].netPay += payroll.net_pay;
      data[monthIndex].employerPension += payroll.employer_pension;
      data[monthIndex].totalDeductions += payroll.total_deductions;
    }
  });

  return data;
});

// Chart series data
const series = computed(() => [
  {
    name: "Net Pay",
    data: monthlyData.value.map((item) => item.netPay),
  },
  {
    name: "Employer Pension",
    data: monthlyData.value.map((item) => item.employerPension),
  },
  {
    name: "Total Deductions",
    data: monthlyData.value.map((item) => item.totalDeductions),
  },
]);

const chartOptions = ref({
  colors: ["#465fff", "#4CAF50", "#FF9800"],
  chart: {
    fontFamily: "Outfit, sans-serif",
    type: "bar",
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "39%",
      borderRadius: 5,
      borderRadiusApplication: "end",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 4,
    colors: ["transparent"],
  },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  legend: {
    show: true,
    position: "top",
    horizontalAlign: "left",
    fontFamily: "Outfit",
    markers: {
      radius: 99,
    },
  },
  yaxis: {
    title: {
      text: "Amount (ETB)",
    },
  },
  grid: {
    yaxis: {
      lines: {
        show: true,
      },
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "ETB " + val.toLocaleString();
      },
    },
  },
});
</script>

<template>
  <div
    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6"
  >
    <div class="flex items-center justify-between">
      <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
        This Month Payroll Summary
      </h3>
    </div>

    <div class="max-w-full overflow-x-auto custom-scrollbar">
      <div id="chartOne" class="-ml-5 min-w-[650px] xl:min-w-full pl-2">
        <VueApexCharts
          type="bar"
          height="300"
          :options="chartOptions"
          :series="series"
        />
      </div>
    </div>
  </div>
</template>
