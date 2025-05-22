<script setup>
import Modal from "@/components/UI/Modal.vue";
import FinanceLayout from "@/layout/FinanceLayout.vue";
import { useEmployeeStore } from "@/stores/employee";
import { usePayrollStore } from "@/stores/payrollStore";
import { onMounted, ref, computed } from "vue";

const { getEmployees } = useEmployeeStore();
const { getAllPayrolls } = usePayrollStore();

const employees = ref([]);
const payrolls = ref([]);

onMounted(async () => {
  employees.value = await getEmployees();
  payrolls.value = await getAllPayrolls();
  console.log(payrolls.value);
});

const parsedPayrolls = computed(() =>
  payrolls.value.map((item) => ({
    ...item,
    allowances: item.allowances ? JSON.parse(item.allowances) : [],
  }))
);

const selectedMonth = ref("");

const filteredPayrolls = computed(() => {
  if (!selectedMonth.value) return parsedPayrolls.value;
  return parsedPayrolls.value.filter((p) => p.month === selectedMonth.value);
});

const showDetailModal = ref(false);
const selectedPayroll = ref(null);

function openDetailModal(item) {
  selectedPayroll.value = item;
  showDetailModal.value = true;
}

function closeDetailModal() {
  showDetailModal.value = false;
  selectedPayroll.value = null;
}
</script>

<template>
  <FinanceLayout>
    <div
      class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 px-4"
    >
      <div class="flex items-center mt-8 gap-2">
        <label
          for="monthFilter"
          class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2"
          >Filter by Month:</label
        >
        <select
          id="monthFilter"
          v-model="selectedMonth"
          class="border rounded px-3 py-2 capitalize dark:bg-gray-900 dark:border-gray-700 dark:text-white/90"
        >
          <option value="">All</option>
          <option value="January">January</option>
          <option value="February">February</option>
          <option value="March">March</option>
          <option value="April">April</option>
          <option value="May">May</option>
          <option value="June">June</option>
          <option value="July">July</option>
          <option value="August">August</option>
          <option value="September">September</option>
          <option value="October">October</option>
          <option value="November">November</option>
          <option value="December">December</option>
        </select>
      </div>
    </div>
    <div
      class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
    >
      <div class="max-w-full overflow-x-auto custom-scrollbar">
        <table class="min-w-full">
          <thead>
            <tr class="border-b border-gray-200 dark:border-gray-700">
              <th class="px-5 py-3 text-left w-3/11 sm:px-6">
                <p
                  class="font-medium text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Employee Name
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Employment Date
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Basic Salary
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Net Pay
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Month
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-nowrap text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Action
                </p>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-if="filteredPayrolls.length === 0">
              <td colspan="7" class="px-5 py-8 text-center sm:px-6">
                <div class="flex flex-col items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-12 w-12 text-gray-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                  <p class="mt-2 text-base text-gray-500">No payroll found</p>
                </div>
              </td>
            </tr>
            <tr
              v-else
              v-for="(item, index) in filteredPayrolls"
              :key="index"
              class="border-t border-gray-100 dark:border-gray-800"
            >
              <td class="px-5 py-4 sm:px-6">
                <span
                  class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"
                >
                  {{ item.employee.name }}
                </span>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <span class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{ item.employee.employement_date }}
                </span>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <span class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{ Number(item.employee.basic_salary).toFixed(2) }}
                </span>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <span class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{ Number(item.net_pay).toFixed(2) }}
                </span>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <span class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{ item.month }}
                </span>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <p
                  @click="openDetailModal(item)"
                  class="cursor-pointer rounded text-nowrap bg-gray-200 p-1 py-2 text-center text-theme-sm font-bold text-gray-500 transition-colors duration-200 hover:bg-success-50 hover:text-success-700"
                >
                  See More
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <Modal v-if="showDetailModal" @close="closeDetailModal">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11"
        >
          <button
            @click="closeDetailModal"
            class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300"
          >
            <svg
              class="fill-current"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                fill=""
              />
            </svg>
          </button>
          <div class="px-2 pr-14">
            <h4
              class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90"
            >
              Payroll Details
            </h4>
          </div>
          <div class="px-2 overflow-y-auto custom-scrollbar">
            <div
              class="grid grid-cols-1 gap-x-6 gap-y-2 lg:grid-cols-2 transition-all ease-linear duration-300"
            >
              <div>
                <strong>Employee Name:</strong>
                {{ selectedPayroll.employee.name }}
              </div>
              <div>
                <strong>Employment Date:</strong>
                {{ selectedPayroll.employee.employement_date }}
              </div>
              <div>
                <strong>Basic Salary:</strong>
                {{ Number(selectedPayroll.employee.basic_salary).toFixed(2) }}
              </div>
              <div>
                <strong>Working Days:</strong>
                {{ Number(selectedPayroll.working_days).toFixed(2) }}
              </div>
              <div>
                <strong>Earned Salary:</strong>
                {{ Number(selectedPayroll.earned_salary).toFixed(2) }}
              </div>
              <div>
                <strong>Gross Pay:</strong>
                {{ Number(selectedPayroll.gross_pay).toFixed(2) }}
              </div>
              <div>
                <strong>Taxable Income:</strong>
                {{ Number(selectedPayroll.taxable_income).toFixed(2) }}
              </div>
              <div>
                <strong>Income Tax:</strong>
                {{ Number(selectedPayroll.income_tax).toFixed(2) }}
              </div>
              <div>
                <strong>Employee Pension:</strong>
                {{ Number(selectedPayroll.employee_pension).toFixed(2) }}
              </div>
              <div>
                <strong>Employer Pension:</strong>
                {{ Number(selectedPayroll.employer_pension).toFixed(2) }}
              </div>
              <div>
                <strong>Loan/Penality:</strong>
                {{ Number(selectedPayroll.loan_or_penality).toFixed(2) }}
              </div>
              <div>
                <strong>Total Deductions:</strong>
                {{ Number(selectedPayroll.total_deductions).toFixed(2) }}
              </div>
              <div><strong>Month:</strong> {{ selectedPayroll.month }}</div>
              <div>
                <strong>Net Pay:</strong>
                {{ Number(selectedPayroll.net_pay).toFixed(2) }}
              </div>
            </div>
            <div class="mt-4">
              <strong>Allowances:</strong>
              <ul>
                <li
                  v-for="a in selectedPayroll.allowances"
                  :key="a.allowances_name"
                  class="mb-2"
                >
                  <span class="font-semibold">{{ a.allowances_name }}:</span>
                  <span class="ml-2 text-gray-700 dark:text-gray-300">
                    Taxable:
                    <span class="font-mono">{{
                      Number(a.taxable).toFixed(2)
                    }}</span
                    >, Non-taxable:
                    <span class="font-mono">{{
                      Number(a.non_taxable).toFixed(2)
                    }}</span>
                  </span>
                </li>
              </ul>
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button
                @click="closeDetailModal"
                type="button"
                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </template>
    </Modal>
  </FinanceLayout>
</template>
