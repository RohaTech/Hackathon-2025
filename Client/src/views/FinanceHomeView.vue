<script setup>
import EmployeeMetrics from "@/components/HeadFinance/EmployeeMetrics.vue";
import MonthlyExpense from "@/components/HeadFinance/MonthlyExpense.vue";
import FinanceLayout from "@/layout/FinanceLayout.vue";
</script>

<template>
  <FinanceLayout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
      <div class="col-span-12 space-y-6 xl:col-span-7">
        <EmployeeMetrics />
      </div>
      <div class="col-span-12 xl:col-span-5"></div>

      <div class="col-span-12">
        <MonthlyExpense />
        <!-- <statistics-chart /> -->
      </div>

      <div class="col-span-12 xl:col-span-5">
        <!-- <customer-demographic /> -->
      </div>

      <div class="col-span-12 xl:col-span-7">
        <!-- <recent-orders /> -->
      </div>
    </div>
  </FinanceLayout>
</template>
