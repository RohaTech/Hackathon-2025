<script setup>
import Logo from "../UI/Logo.vue";
import FooterBackground from "/images/General/Footer_Background.png";
</script>

<template>
  <div
    class="mt-24 min-h-[400px] w-full bg-black bg-cover bg-center pb-1 text-white"
    :style="{ backgroundImage: `url(${FooterBackground})` }"
  >
    <div
      class="grid grid-cols-3 place-items-center gap-2 divide-x-2 border-b border-white"
    >
      <div class="flex gap-x-4 p-16">
        <div
          class="flex size-14 items-center justify-center rounded-full border border-white p-2"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-7 fill-white"
            viewBox="0 0 256 256"
          >
            <path
              d="M128,16a88.1,88.1,0,0,0-88,88c0,75.3,80,132.17,83.41,134.55a8,8,0,0,0,9.18,0C136,236.17,216,179.3,216,104A88.1,88.1,0,0,0,128,16Zm0,56a32,32,0,1,1-32,32A32,32,0,0,1,128,72Z"
            ></path>
          </svg>
        </div>

        <div class="">
          <p class="font-semibold text-first-accent">Address</p>
          <p class="text-xl font-bold">Kombolcha , Amhara</p>
        </div>
      </div>
      <div class="flex gap-x-4 p-16">
        <div
          class="flex size-14 items-center justify-center rounded-full border border-white p-2"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-7 fill-white"
            viewBox="0 0 256 256"
          >
            <path
              d="M144.27,45.93a8,8,0,0,1,9.8-5.66,86.22,86.22,0,0,1,61.66,61.66,8,8,0,0,1-5.66,9.8A8.23,8.23,0,0,1,208,112a8,8,0,0,1-7.73-5.93,70.35,70.35,0,0,0-50.33-50.34A8,8,0,0,1,144.27,45.93Zm-2.33,41.8c13.79,3.68,22.65,12.55,26.33,26.34A8,8,0,0,0,176,120a8.23,8.23,0,0,0,2.07-.27,8,8,0,0,0,5.66-9.8c-5.12-19.16-18.5-32.54-37.66-37.66a8,8,0,1,0-4.13,15.46Zm72.43,78.73-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L126.87,168c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L89.54,41.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,24,88c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,214.37,166.46Z"
            ></path>
          </svg>
        </div>

        <div class="">
          <p class="font-semibold text-first-accent">Phone</p>
          <a target="_blank" href="tel:+251912345678" class="text-xl font-bold"
            >+251912345678</a
          >
        </div>
      </div>
      <div class="flex gap-x-4 p-16">
        <div
          class="flex size-14 items-center justify-center rounded-full border border-white p-2"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-7 fill-white"
            viewBox="0 0 256 256"
          >
            <path
              d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"
            ></path>
          </svg>
        </div>

        <div class="">
          <p class="font-semibold text-first-accent">Email</p>
          <a
            target="_blank"
            href="mailto:rohatechofficial@gmail.com"
            class="text-xl font-bold"
            >rohatechofficial@gmail.com</a
          >
        </div>
      </div>
    </div>

    <div class="my-16 grid grid-cols-4 pl-32">
      <div class="space-y-8">
        <Logo class="w-[200px]" />
        <p class="w-[250px]">
          Tenadam connects rural Ethiopia with quality healthcare through
          telemedicine
        </p>

        <div class="flex items-center gap-x-2">
          <div
            class="relative flex size-12 items-center justify-center rounded-full bg-[#4d5756]"
          >
            <a
              target="_blank"
              href="https://instagram.com/ "
              class="absolute inset-0"
            ></a>

            <svg
              class="size-5 fill-white"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512"
            >
              <path
                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
              />
            </svg>
          </div>
          <div
            class="relative flex size-12 items-center justify-center rounded-full bg-[#4d5756]"
          >
            <a
              target="_blank"
              href="https://facebook.com/ "
              class="absolute inset-0"
            ></a>

            <svg
              class="size-5 fill-white"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 320 512"
            >
              <path
                d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"
              />
            </svg>
          </div>
          <div
            class="relative flex size-12 items-center justify-center rounded-full bg-[#4d5756]"
          >
            <a
              target="_blank"
              href="https://linkedin.com/home"
              class="absolute inset-0"
            ></a>

            <svg
              class="size-5 fill-white"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512"
            >
              <path
                d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"
              />
            </svg>
          </div>
          <div
            class="relative flex size-12 items-center justify-center rounded-full bg-[#4d5756]"
          >
            <a
              target="_blank"
              href="https://x.com/home"
              class="absolute inset-0"
            ></a>

            <svg
              class="size-5 fill-white"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z"
              />
            </svg>
          </div>
        </div>
      </div>

      <div class="">
        <h1 class="font-bold">Quick Links</h1>
        <ul class="mt-2 space-y-2">
          <li class="">Home</li>
          <li class="">Services</li>
          <li class="">Categories</li>
          <li class="">Features</li>
          <li class="">Blog News</li>
        </ul>
      </div>
      <div class="">
        <h1 class="font-bold">Support & Resources</h1>
        <ul class="mt-2 space-y-2">
          <li class="">User Guide</li>
          <li class="">Privacy Policy</li>
          <li class="">Terms of Service</li>
          <li class="">Support Center</li>
          <li class="">Blog News</li>
        </ul>
      </div>

      <div class="space-y-4">
        <p class="font-semibold">Contact Us</p>

        <input type="email" placeholder="Enter your  email" class="p-2" />
        <br />
        <button
          type="submit"
          class="rounded-sm bg-first-accent px-10 py-2.5 text-sm"
        >
          Email Us
        </button>
      </div>
    </div>

    <div
      class="flex items-center justify-center gap-x-1 py-3 text-gray-400"
      :style="{ backgroundImage: `url(${FooterBackground})` }"
    >
      <span class="">Copyright &#64; 2025</span>
      <span class="font-bold text-second-accent">Tenadam</span>
      <span class="">|| All Rights Reserved</span>
    </div>
  </div>
</template>
