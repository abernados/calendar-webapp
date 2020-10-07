<template>
  <div class="grid grid-cols-4">
    <div class="p-6">
      <div class="flex items-center border-b-2 pb-3">
        <div class="text-lg leading-7 font-semibold">Add an Event</div>
      </div>

      <div class="pt-3">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
          <form class="w-full">
            <div class="flex flex-wrap -mx-3">
              <div class="w-full px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="grid-password"
                >
                  The name of event is
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  type="text"
                  v-model="form.event_name"
                  @click="open"
                />
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3 mb-6 md:mb-0">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="grid-first-name"
                >
                  Will start at
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                  type="date"
                  v-model="form.start_date"
                  min="2020-10-01"
                  max="2020-10-31"
                />
              </div>
              <div class="w-full px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="grid-last-name"
                >
                  Will end at
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  type="date"
                  v-model="form.end_date"
                  min="2020-10-01"
                  max="2020-10-31"
                />
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <div class="block">
                  <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  >
                    Repeat every
                  </label>
                  <div class="mt-2 flex flex-wrap">
                    <div v-for="(day_label, index) in weekdays_label">
                      <label class="inline-flex items-center mx-3">
                        <input
                          type="checkbox"
                          class="form-checkbox text-indigo-600"
                          :value="day_label"
                          v-model="form.selectedDaysPerWeek"
                        />
                        <span class="ml-2">{{ day_label }}</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button
              type="button"
              @click="addToDB"
              class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
            >
              Save Event
            </button>
          </form>
        </div>
      </div>
    </div>

    <div
      class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l col-span-3"
    >
      <div class="flex items-center border-b-2 pb-3">
        <div class="ml-4 text-lg leading-7 font-semibold">
          Calendar - {{ moment(new Date()).format("MMMM YYYY") }}
        </div>
      </div>

      <div class="pt-3">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
          <div class="grid grid-cols-7 gap-4">
            <div v-for="day in weekdays_label" class="px-6 py-8">
              <p class="font-bold text-2xl text-blue-600">
                {{ day }}
              </p>
            </div>
            <div
              v-for="(day, index) in weekdays"
              class="p-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
            >
              <p class="font-bold text-2xl text-blue-600">
                <span v-if="whatDayToday(day, index)">{{ day }}</span>
              </p>
            </div>
            <div
              v-for="index in 30"
              class="p-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
            >
              <p class="font-bold text-2xl text-blue-600">
                {{ index }}
              </p>
              Event Title # {{ index }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  name: "add-event-page",
  data() {
    return {
      loading: false,
      moment: moment,
      first_day: moment().startOf("month").format("dddd"),
      weekdays: moment.weekdays(),
      weekdays_label: moment.weekdaysShort(),
      form: {
        event_name: null,
        start_date: new Date(),
        end_date: new Date(),
        selectedDaysPerWeek: [],
      },
    };
  },
  methods: {
    open() {
      this.$toast.open({
        message: moment.weekdays(),
        type: "success",
        duration: 3000,
        dismissible: true,
        position: "top-right",
        pauseOnHover: true,
      });
    },
    days() {
      return Array.from(
        Array(moment(new Date()).daysInMonth()),
        (_, i) => i + 1
      );
    },
    whatDayToday(day, index) {
      if (day == this.first_day) {
        console.log(this.weekdays.length - index);
        console.log(index);
        this.weekdays.splice(index, this.weekdays.length - index);
      }
    },
    addToDB() {
      console.error(this.form);
    },
  },
};
</script>
