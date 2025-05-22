<script setup>
import Modal from "@/components/UI/Modal.vue";
import FinanceLayout from "@/layout/FinanceLayout.vue";
import { useEmployeeStore } from "@/stores/employee";
import { usePayrollStore } from "@/stores/payrollStore";
import { onMounted, ref } from "vue";

const isAddPaymentModal = ref(false);
const { getEmployees } = useEmployeeStore();
const { createPayroll } = usePayrollStore();

const employees = ref([]);

onMounted(async () => {
  employees.value = await getEmployees();
  console.log(employees.value);
});

const formData = ref({
  employee_id: "",
  working_days: "",
  other_commissions: "",
  loan_or_penality: "",
  month: "",
});

const saveProfile = async () => {
  if (formData.value.working_days > 30) {
    alert("Working days cannot exceed 30");
    return;
  }
  console.log(formData.value);
  await createPayroll(formData.value);
  console.log("Profile saved");
  closeModal();
};

const closeModal = () => {
  isAddPaymentModal.value = false;

  formData.value = {
    employee_id: "",
    working_days: "",
    other_commissions: "",
    loan_or_penality: "",
    month: "",
  };
};
</script>

<template>
  <FinanceLayout>
    <h1 class="font-bold text-xl">Payroll</h1>

    <div class="px-4 w-full flex flex-col">
      <button
        @click="isAddPaymentModal = true"
        class="bg-white px-4 py-3 text-sm text-gray-700 ring-1 ring-inset ring-gray-300 ark:bg-gray-800 ark:text-gray-400 ark:ring-gray-700 ark:hover:bg-white/[0.03] ark:hover:text-gray-300 inline-flex items-center justify-center font-medium gap-2 rounded-lg transition w-fit ml-auto mr-6 hover:bg-[#f3a21b] hover:text-white"
      >
        New Payment
      </button>
    </div>

    <Modal v-if="isAddPaymentModal" @close="isAddPaymentModal = false">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 ark:bg-gray-900 lg:p-11"
        >
          <!-- close btn -->
          <button
            @click="closeModal"
            class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 ark:bg-white/[0.05] ark:text-gray-400 ark:hover:bg-white/[0.07] ark:hover:text-gray-300"
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
              class="mb-2 text-2xl font-semibold text-gray-800 ark:text-white/90"
            >
              ADD NEW PAYMENT
            </h4>
          </div>
          <form class="flex flex-col mt-8">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="my-4">
                <label
                  class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                >
                  Employee
                </label>

                <select
                  v-model="formData.employee_id"
                  class="w-full border rounded px-3 py-2 capitalize"
                >
                  <option
                    v-for="(employee, index) in employees"
                    :key="index"
                    :value="employee.id"
                    class="capitalize"
                  >
                    {{ employee.name }}
                  </option>
                </select>
              </div>

              <div
                class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2 transition-all ease-linear duration-300"
              >
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Working Days
                  </label>
                  <input
                    type="number"
                    value="0"
                    max="30"
                    required
                    v-model="formData.working_days"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Other Commissions
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.other_commissions"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    loan or penality
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.loan_or_penality"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>

                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Month
                  </label>
                  <select
                    v-model="formData.month"
                    required
                    class="w-full border rounded px-3 py-2 capitalize ark:bg-ark-900 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90"
                  >
                    <option value="" disabled>Select month</option>
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
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button
                @click="closeModal"
                type="button"
                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 ark:border-gray-700 ark:bg-gray-800 ark:text-gray-400 ark:hover:bg-white/[0.03] sm:w-auto"
              >
                Close
              </button>
              <button
                @click="saveProfile"
                type="button"
                class="flex w-full justify-center rounded-lg bg-[#2D479B] px-4 py-2 text-sm font-medium text-white hover:bg-[#f3a21b] sm:w-auto"
              >
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </template>
    </Modal>
  </FinanceLayout>
</template>
