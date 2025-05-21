<script setup>
import Modal from "@/components/UI/Modal.vue";
import FinanceLayout from "@/layout/FinanceLayout.vue";
import { ref } from "vue";

const isProfileAddressModal = ref(false);

const saveProfile = () => {
  // Implement save profile logic here
  console.log("Profile saved");
  isProfileInfoModal.value = false;
};
</script>

<template>
  <FinanceLayout>
    <h1 class="font-bold text-xl">Payroll</h1>

    <div class="px-4 w-full flex flex-col">
      <button
        @click="isProfileAddressModal = true"
        class="bg-white px-4 py-3 text-sm text-gray-700 ring-1 ring-inset ring-gray-300 ark:bg-gray-800 ark:text-gray-400 ark:ring-gray-700 ark:hover:bg-white/[0.03] ark:hover:text-gray-300 inline-flex items-center justify-center font-medium gap-2 rounded-lg transition w-fit ml-auto mr-6 hover:bg-[#f3a21b] hover:text-white"
      >
        New Payment
      </button>
    </div>

    <Modal v-if="isProfileAddressModal" @close="isProfileAddressModal = false">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 ark:bg-gray-900 lg:p-11"
        >
          <!-- close btn -->
          <button
            @click="isProfileAddressModal = false"
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
              Edit Address
            </h4>
            <p class="mb-6 text-sm text-gray-500 ark:text-gray-400 lg:mb-7">
              Update your details to keep your profile up-to-date.
            </p>
          </div>
          <form class="flex flex-col">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                <div>
                  <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Country
                  </label>
                  <input
                    type="text"
                    value="United States"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>

                <div>
                  <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    City/State
                  </label>
                  <input
                    type="text"
                    value="Poenix, Arizona, United States"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>

                <div>
                  <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    Postal Code
                  </label>
                  <input
                    type="text"
                    value="ERT 2489"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>

                <div>
                  <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 ark:text-gray-400"
                  >
                    TAX ID
                  </label>
                  <input
                    type="text"
                    value="AS4568384"
                    class="ark:bg-ark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-[#2D479B]/10 ark:border-gray-700 ark:bg-gray-900 ark:text-white/90 ark:placeholder:text-white/30 ark:focus:border-brand-800"
                  />
                </div>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button
                @click="isProfileAddressModal = false"
                type="button"
                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 ark:border-gray-700 ark:bg-gray-800 ark:text-gray-400 ark:hover:bg-white/[0.03] sm:w-auto"
              >
                Close
              </button>
              <button
                @click="saveProfile"
                type="button"
                class="flex w-full justify-center rounded-lg bg-[#2D479B] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#f3a21b] sm:w-auto"
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
