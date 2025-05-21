<script setup>
import HeadFinanceLayout from "@/layout/HeadFinanceLayout.vue";
import Modal from "@/components/UI/Modal.vue";
import { onMounted, ref } from "vue";
import { useAllowanceStore } from "@/stores/allowanceStore";

const isAddAllowanceModal = ref(false);
const isAllowanceDetail = ref(false);
const selectedAllowance = ref([]);
const { createAllowance, getAllAllowances, updateAllowance, deleteAllowance } =
  useAllowanceStore();

const formData = ref({
  allowances_name: "",
  ceo: null,
  coo: null,
  cto: null,
  ciso: null,
  director: null,
  dept_lead: null,
  normal_employee: null,
  positioned: null,
  non_positioned: null,
});
const updatedAllowanceData = ref({
  allowances_name: "",
  ceo: null,
  coo: null,
  cto: null,
  ciso: null,
  director: null,
  dept_lead: null,
  normal_employee: null,
  positioned: null,
  non_positioned: null,
});

const withPosition = ref(true);
const allowances = ref([]);

onMounted(async () => {
  allowances.value = await getAllAllowances();
  console.log(allowances.value);
});

const saveProfile = async () => {
  await createAllowance(formData.value);
  allowances.value = await getAllAllowances();
  console.log("Allowance saved");
  console.log(formData.value);
  isAddAllowanceModal.value = false;
};
const HandleUpdateAllowance = async () => {
  await updateAllowance(updatedAllowanceData.value, selectedAllowance.value.id);
  allowances.value = await getAllAllowances();
  console.log("Allowance Update");
  console.log(updatedAllowanceData.value);
  isAllowanceDetail.value = false;
};
const HandleDeleteAllowance = async () => {
  await deleteAllowance(selectedAllowance.value.id);
  allowances.value = await getAllAllowances();
  console.log("Allowance Deleted");
  isAllowanceDetail.value = false;
};
const handleToggle = () => {
  withPosition.value = !withPosition.value;
  formData.value.ceo = null;
  formData.value.coo = null;
  formData.value.cto = null;
  formData.value.ciso = null;
  formData.value.director = null;
  formData.value.dept_lead = null;
  formData.value.normal_employee = null;
  formData.value.non_positioned = null;
  formData.value.positioned = null;
};

const openDetailPopup = (allowance) => {
  selectedAllowance.value = allowance;
  isAllowanceDetail.value = true;
  updatedAllowanceData.value = selectedAllowance.value;
  console.log(updatedAllowanceData.value);
};
</script>

<template>
  <HeadFinanceLayout>
    <h1 class="font-bold text-xl">Allowance Deduction Rules</h1>

    <div class="px-4 w-full flex flex-col">
      <button
        @click="isAddAllowanceModal = true"
        class="bg-white px-4 py-3 text-sm text-gray-700 ring-1 ring-inset ring-gray-300 ark:bg-gray-800 ark:text-gray-400 ark:ring-gray-700 ark:hover:bg-white/[0.03] ark:hover:text-gray-300 inline-flex items-center justify-center font-medium gap-2 rounded-lg transition w-fit ml-auto mr-6 hover:bg-[#f3a21b] hover:text-white"
      >
        New Allowance
      </button>
    </div>

    <Modal v-if="isAddAllowanceModal" @close="isAddAllowanceModal = false">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 ark:bg-gray-900 lg:p-11"
        >
          <!-- close btn -->
          <button
            @click="isAddAllowanceModal = false"
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
              Add New Allowance
            </h4>
          </div>

          <div class="flex gap-x-10 items-center my-6">
            <div
              class="flex gap-x-2 items-center cursor-pointer"
              @click="handleToggle"
            >
              <div
                class="rounded-full size-5 border-2 border-black"
                :class="{ 'bg-[#0a5098] border-none': withPosition }"
              ></div>
              <span class="text-sm lowercase">With Specific Position</span>
            </div>
            <div
              class="flex gap-x-2 items-center cursor-pointer"
              @click="handleToggle"
            >
              <div
                class="rounded-full size-5 border-2 border-black"
                :class="{ 'bg-[#0a5098] border-none': !withPosition }"
              ></div>
              <span class="text-sm lowercase">Positioned/Non Positioned</span>
            </div>
          </div>
          <form class="flex flex-col mt-8">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="my-4">
                <label for="name" class="mb-1 block text-sm text-[#0F172A]">
                  Allowance Name <span class="text-red-500">*</span>
                </label>
                <input
                  id="name"
                  v-model="formData.allowances_name"
                  type="text"
                  class="ark:bg-dark-900 focus:outline-hidden ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-first-accent"
                  placeholder="Enter Allowance Name"
                  required
                />
                <!-- <p
                  v-if="errors?.name"
                  class="mt-2 text-xs font-semibold text-red-500"
                >
                  {{ errors.name }}
                </p> -->
              </div>

              <div
                v-if="withPosition"
                class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2 transition-all ease-linear duration-300"
              >
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Ceo
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.ceo"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    coo
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.coo"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    cto
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.cto"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    ciso
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.ciso"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    director
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.director"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    department lead
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.dept_lead"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    normal_employee
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.normal_employee"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
              </div>
              <div
                v-if="!withPosition"
                class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2 transition-all ease-linear duration-700"
              >
                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    positioned
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.positioned"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>

                <div>
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    non positioned
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    v-model="formData.non_positioned"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button
                @click="isAddAllowanceModal = false"
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

    <p class="capitalize font-semibold text-xl mt-8 mb-6">Allowance Lists</p>
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
                  Allowance Name
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Ceo Value
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Cto Value
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Positioned Employee
                </p>
              </th>
              <th class="px-5 py-3 text-left w-2/11 sm:px-6">
                <p
                  class="font-medium capitalize text-gray-500 text-theme-xs dark:text-gray-400"
                >
                  Non Positioned Employee
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
            <tr
              v-for="(allowance, index) in allowances"
              :key="index"
              class="border-t border-gray-100 dark:border-gray-800"
            >
              <td class="px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                  <div>
                    <span
                      class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"
                    >
                      {{ allowance.allowances_name }}
                    </span>
                  </div>
                </div>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{ allowance.ceo !== null ? allowance.ceo : "Not Specified" }}
                </p>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{ allowance.cto !== null ? allowance.cto : "Not Specified" }}
                </p>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{
                    allowance.positioned !== null
                      ? allowance.positioned
                      : "Not Specified"
                  }}
                </p>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                  {{
                    allowance.non_positioned !== null
                      ? allowance.non_positioned
                      : "Not Specified"
                  }}
                </p>
              </td>
              <td class="px-5 py-4 sm:px-6">
                <p
                  @click="openDetailPopup(allowance)"
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

    <Modal v-if="isAllowanceDetail" @close="isAllowanceDetail = false">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 ark:bg-gray-900 lg:p-11"
        >
          <!-- close btn -->
          <button
            @click="isAllowanceDetail = false"
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
              Allowance Detail
            </h4>
          </div>

          <form class="flex flex-col mt-8">
            <div class="my-4">
              <label for="name" class="mb-1 block text-sm text-[#0F172A]">
                Allowance Name <span class="text-red-500">*</span>
              </label>
              <input
                id="name"
                v-model="updatedAllowanceData.allowances_name"
                type="text"
                class="ark:bg-dark-900 focus:outline-hidden ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-first-accent"
                placeholder="Enter Allowance Name"
                required
              />
              <!-- <p
                  v-if="errors?.name"
                  class="mt-2 text-xs font-semibold text-red-500"
                >
                  {{ errors.name }}
                </p> -->
            </div>
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div
                class="grid grid-cols-1 gap-x-6 gap-y-2 lg:grid-cols-2 transition-all ease-linear duration-300"
              >
                <div v-if="updatedAllowanceData.ceo !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Ceo
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.ceo === null"
                    required
                    v-model="updatedAllowanceData.ceo"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.coo !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    coo
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.coo === null"
                    required
                    v-model="updatedAllowanceData.coo"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.cto !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    cto
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.cto === null"
                    required
                    v-model="updatedAllowanceData.cto"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.ciso !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    ciso
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.ciso === null"
                    required
                    v-model="updatedAllowanceData.ciso"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.director !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    director
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.director === null"
                    required
                    v-model="updatedAllowanceData.director"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.dept_lead !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    department lead
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.dept_lead === null"
                    required
                    v-model="updatedAllowanceData.dept_lead"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.normal_employee !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    normal employee
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    :disabled="updatedAllowanceData.normal_employee === null"
                    v-model="updatedAllowanceData.normal_employee"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.positioned !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Positioned
                  </label>
                  <input
                    type="number"
                    value="0"
                    required
                    :disabled="updatedAllowanceData.positioned === null"
                    v-model="updatedAllowanceData.positioned"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
                <div v-if="updatedAllowanceData.non_positioned !== null">
                  <label
                    class="mb-1.5 block uppercase text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Non Positioned
                  </label>
                  <input
                    type="number"
                    value="0"
                    :disabled="updatedAllowanceData.non_positioned === null"
                    required
                    v-model="updatedAllowanceData.non_positioned"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button
                @click="HandleDeleteAllowance"
                type="button"
                class="flex w-full justify-center rounded-lg bg-[#2D479B] px-4 py-2 text-sm font-medium text-white hover:bg-red-500 sm:w-auto"
              >
                Delete Allowance
              </button>
              <button
                @click="HandleUpdateAllowance"
                type="button"
                class="flex w-full justify-center rounded-lg bg-[#2D479B] px-4 py-2 text-sm font-medium text-white hover:bg-[#f3a21b] sm:w-auto"
              >
                Update Changes
              </button>

              <button
                @click="isAllowanceDetail = false"
                type="button"
                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 ark:border-gray-700 ark:bg-gray-800 ark:text-gray-400 ark:hover:bg-white/[0.03] sm:w-auto"
              >
                Close
              </button>
            </div>
          </form>
        </div>
      </template>
    </Modal>
  </HeadFinanceLayout>
</template>
