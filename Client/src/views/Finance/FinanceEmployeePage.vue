<script setup>
import FinanceLayout from "@/layout/FinanceLayout.vue";
import { useEmployeeStore } from "@/stores/employee";
import { onMounted, ref, computed } from "vue";
import Modal from "@/components/UI/Modal.vue";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

const { getEmployees, addEmployee } = useEmployeeStore();
const employees = ref([]);

onMounted(async () => {
  employees.value = await getEmployees();
  console.log(employees.value);
});

const showPopup = ref(false);
const selectedEmployee = ref(null);

const openDetailPopup = (employee) => {
  
  selectedEmployee.value = employee;
  console.log(selectedEmployee.value);
  showPopup.value = true;
  console.log(showPopup.value);
};

const closePopup = () => {
  showPopup.value = false;
};

const rename = (value) => {
  if (value === "full_time") {
    return "Full Time";
  } else if (value === "part_time") {
    return "Part Time";
  } else {
    return value;
  }
};

const showAddEmployeeModal = ref(false);
const newEmployee = ref({
  name: '',
  gender: '',
  email: '',
  employement_type: 'full_time',
  position: '',
  employement_date: '',
  basic_salary: '',
  account_number: '',
  balance: 0,
});

const openAddEmployeeModal = () => {
  showAddEmployeeModal.value = true;
};
const closeAddEmployeeModal = () => {
  showAddEmployeeModal.value = false;
  // Reset form fields
  newEmployee.value = {
    name: '',
    email: '',
    gender: '',
    employement_type: 'full_time',
    position: '',
    employement_date: '',
    basic_salary: '',
    account_number: '',
    balance: 0,
  };
};

const submitAddEmployee = async () => {
  await addEmployee({
    ...newEmployee.value,
    // account: { account_number: newEmployee.value.account_number },
  });
  employees.value = await getEmployees();
  closeAddEmployeeModal();
};


</script>

<template>
  <FinanceLayout>
    <button
      @click="openAddEmployeeModal"
      class="my-4 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
    >
      Add Employee
    </button>
    <div class="custom-scrollbar max-w-full overflow-x-auto">
      <table class="min-w-full border-t-2">
        <thead>
          <tr class="ark:border-gray-700 border-b border-gray-200">
            <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Employee Name</p>
            </th>
            <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Email</p>
            </th>
            <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Employement Type</p>
            </th>
            <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">position</p>
            </th>
            <!-- <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Employement Date</p>
            </th> -->
            <th class="w-2/15 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Basic Salary</p>
            </th>
            <!-- <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Employement Date</p>
            </th> -->
            <th class="w-2/11 px-5 py-3 text-left sm:px-6">
              <p class="text-theme-xs font-medium text-gray-500">Actions </p>
            </th>
          </tr>
        </thead>
      <tbody class="ark:divide-gray-700 divide-y divide-gray-200">
          <!-- No results message -->
          <tr v-if="employees.length === 0">
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
                <p class="mt-2 text-base text-gray-500">
                  No doctors found with status:
                  <span class="font-medium capitalize">{{
                    selectedStatus
                  }}</span>
                </p>
                <button
                  @click="changeStatus('all')"
                  class="mt-4 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                  Show All Doctors
                </button>
              </div>
            </td>
          </tr>
          <tr
            v-for="(employee, index) in employees"
            :key="index"
            class="ark:border-gray-800 border-t border-gray-100"
          >
            <td class="px-5 py-4 sm:px-6">
              <div class="flex items-center gap-3">
                <div>
                  <span class="block text-theme-sm font-medium text-gray-800">
                    {{ employee.name }}
                  </span>
                </div>
              </div>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-theme-sm text-gray-500">
                {{ employee.email }}
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-theme-sm text-gray-500">
                {{ rename(employee.employement_type) }}
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p class="text-theme-sm text-gray-500 uppercase">
                {{ employee.position }}
              </p>
            </td>
            <!-- <td class="px-5 py-4 sm:px-6">
              <p class="text-theme-sm text-gray-500">
                {{ employee.employement_date }}
              </p>
            </td> -->
            <td class="px-5 py-4 sm:px-6">
              <p class="text-theme-sm text-gray-500">
                <span
                  
                >
                  {{ employee.basic_salary }}</span
                >
              </p>
            </td>
            <td class="px-5 py-4 sm:px-6">
              <p
                @click="openDetailPopup(employee)"
                class="cursor-pointer rounded bg-gray-200 p-1 py-2 text-center text-theme-sm font-bold text-gray-500 transition-colors duration-200 hover:bg-success-50 hover:text-success-700"
              >
                More Detail
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  <Modal v-if="showPopup" @close="closePopup" :fullScreenBackdrop="true">
      <template #body>
        <div
          class="relative max-h-[700px] w-full max-w-[700px] overflow-y-auto overflow-x-hidden rounded-3xl bg-white p-4 lg:p-11"
        >
          <h5
            class="modal-title mb-2 text-theme-xl font-semibold text-gray-800 lg:text-2xl"
          >
            Employee Details
          </h5>
          <p class="text-sm text-gray-500">
            Review doctor information and credentials
          </p>

          <div v-if="selectedEmployee" class="mt-8">
            <!-- Basic Info Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <div>
                <label class="mb-1.5 block text-md font-bold text-gray-700">
                  Employee Name
                </label>
                <p class="text-base text-gray-800">
                  {{ selectedEmployee.name }}
                </p>

                <div class="mt-4">
                  <label class="mb-1.5 block text-md font-bold text-gray-700">
                    Email Address
                  </label>
                  <p class="text-base text-gray-800">
                    {{ selectedEmployee.email }}
                  </p>
                </div>

                <div class="mt-4">
                  <label class="mb-1.5 block text-md font-bold text-gray-700">
                    Employement Type
                  </label>
                  <p class="text-base text-gray-800">
                    {{ rename(selectedEmployee.employement_type)}} 
                  </p>
                </div>

                <div class="mt-4">
                  <label class="mb-1.5 block text-md font-bold text-gray-700">
                    Employement Date
                  </label>
                  <p class="text-base text-gray-800">
                    {{ selectedEmployee.employement_date || "Not provided" }}
                  </p>
                </div>
              </div>

              <!-- Professional Info Section -->
              <div>
                <label class="mb-1.5 block text-md font-bold text-gray-700">
                  Basic Salary
                </label>
                <p class="text-base text-gray-800">
                  {{ selectedEmployee.basic_salary || "Not provided" }}
                </p>

                <div class="mt-4">
                  <label class="mb-1.5 block text-md font-bold text-gray-700">
                    Account Number
                  </label>
                  <p class="text-base text-gray-800">
                    {{ selectedEmployee.account.account_number || "Not provided" }}
                  </p>
                </div>

                <!-- <div class="mt-4">
                  <label class="mb-1.5 block text-md font-bold text-gray-700">
                    Experience (Years)
                  </label>
                  <p class="text-base text-gray-800">
                    {{ selectedEmployee.experience_years || "Not provided" }}
                  </p>
                </div> -->

                <!-- <div class="mt-4">
                  <label class="mb-1.5 block text-md font-bold text-gray-700">
                    University Attended
                  </label>
                  <p class="text-base text-gray-800">
                    {{ selectedDoctor.university_attended || "Not provided" }}
                  </p>
                </div> -->
              </div>
            </div>

            <!-- Location and License Info Section -->
            

            <!-- License Dates and Status -->
            <div class="mt-6">
              <!-- <label class="mb-1.5 block text-sm font-medium text-gray-700">
                License Details
              </label> -->
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <!-- <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    License Number
                  </label> -->
                  <!-- <p class="text-base text-gray-800">
                    {{
                      selectedDoctor.medical_license_number || "Not provided"
                    }}
                  </p> -->
                </div>
                <div>
                  <!-- <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Issue Date
                  </label> -->
                  <!-- <p class="text-base text-gray-800">
                    {{ selectedDoctor.license_issue_date || "Not provided" }}
                  </p> -->
                </div>
                <div>
                  <!-- <label class="mb-1.5 block text-sm font-medium text-gray-700">
                    Expiry Date
                  </label> -->
                  <!-- <p class="text-base text-gray-800">
                    {{ selectedDoctor.license_expiry_date || "Not provided" }}
                  </p> -->
                </div>
              </div>
            </div>

            <!-- Status and Actions -->
            <div class="mt-6">
              <!-- <div class="flex items-end gap-x-4">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">
                  Status
                </label>
                <span
                  :class="[
                    'rounded-xl border px-3 py-1 text-sm font-medium',
                    {
                      'bg-success-50 text-success-700':
                        selectedDoctor.status === 'active',
                      'bg-warning-50 text-warning-700':
                        selectedDoctor.status === 'pending',
                      'bg-error-50 text-error-700':
                        selectedDoctor.status === 'suspended' ||
                        selectedDoctor.status === 'expired',
                    },
                  ]"
                >
                  {{ selectedDoctor.status }}
                </span>
              </div> -->
            
            </div>

            <!-- Action buttons -->
            <div
              class="modal-footer mt-8 flex items-center gap-3 sm:justify-end"
            >
              <button
                @click="closePopup"
                class="ark:border-gray-700 ark:bg-gray-800 ark:hover:bg-white/[0.03] flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 sm:w-auto"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </template>
    </Modal>

    <Modal v-if="showAddEmployeeModal" @close="closeAddEmployeeModal" :fullScreenBackdrop="true">
      <template #body>
        <div class="relative max-h-[700px] w-full max-w-[700px] overflow-y-auto overflow-x-hidden rounded-3xl bg-white p-4 lg:p-11">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Add Employee</h2>
            <button @click="closeAddEmployeeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
          </div>
          <form @submit.prevent="submitAddEmployee">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block mb-1 font-medium">Name</label>
                <input v-model="newEmployee.name" type="text" required class="w-full border rounded px-3 py-2" />
              </div>
              <div>
                <label class="block mb-1 font-medium">Email</label>
                <input v-model="newEmployee.email" type="email" required class="w-full border rounded px-3 py-2" />
              </div>
              <div>
                <label class="block mb-1 font-medium">Employment Type</label>
                <select v-model="newEmployee.employement_type" class="w-full border rounded px-3 py-2">
                  <option value="full_time">Full Time</option>
                  <option value="part_time">Part Time</option>
                </select>
              </div>
              <div>
                <label class="block mb-1 font-medium">Employment Type</label>
                <select v-model="newEmployee.position" class="w-full border rounded px-3 py-2">
                  <option value="ceo">CEO</option>
                  <option value="coo">COO</option>
                  <option value="cto">CTO</option>
                  <option value="ciso">CISO</option>
                  <option value="director">Director</option>
                  <option value="dept_lead">Department Leader</option>
                  <option value="normal_employee">Normal Employee</option>
                </select>
              </div>
              <!-- <div>
                <label class="block mb-1 font-medium">Position</label>
                <input v-model="newEmployee.position" type="text" required class="w-full border rounded px-3 py-2" />
              </div> -->
              <div>
                <label
                  for="birth_date"
                  class="mb-1 block text-sm text-[#0F172A]"
                >
                 Employment Date<span class="text-red-500">*</span>
                </label>
                <flat-pickr
                  v-model="newEmployee.employement_date"
                  :config="flatpickrConfig"
                  class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-first-accent"
                  placeholder="Select date"
                  required
                />
              </div>
              <!-- <div>
                <label class="block mb-1 font-medium">Employment Date</label>
                <input v-model="newEmployee.employement_date" type="date" required class="w-full border rounded px-3 py-2" />
              </div> -->
              <div>
                <label class="block mb-1 font-medium">Basic Salary</label>
                <input v-model="newEmployee.basic_salary" type="number" required class="w-full border rounded px-3 py-2" />
              </div>
              <div class="">
                <label class="block mb-1 font-medium">Account Number</label>
                <input v-model="newEmployee.account_number" type="text" required class="w-full border rounded px-3 py-2" />
              </div>
              <div>
                <label class="block mb-1 font-medium">Gender</label>
                <select v-model="newEmployee.gender" class="w-full border rounded px-3 py-2">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>
            <div class="modal-footer mt-8 flex items-center gap-3 sm:justify-end">
              <button type="button" @click="closeAddEmployeeModal" class="ark:border-gray-700 ark:bg-gray-800 ark:hover:bg-white/[0.03] flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 sm:w-auto">Close</button>
              <button type="submit" class="flex w-full justify-center rounded-lg border border-[#0a5098] bg-[#121fb5] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#0a1698] sm:w-auto">Submit</button>
            </div>
          </form>
        </div>
      </template>
    </Modal>

  </FinanceLayout>
</template>
