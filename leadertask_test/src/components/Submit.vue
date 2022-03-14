<template>
  <form>
    <h1>Форма обратной связи</h1>
    <div class="form-group">
      <input
        type="text"
        id="name"
        class="form-control"
        placeholder="Ваше имя"
        v-model.trim="state.form.name"
      >
      <span v-if="v$.form.name.$error">
        {{ v$.form.name.$errors[0].$message}}
      </span>
    </div>
    <div class="form-group">
      <input
        type="email"
        id="email"
        class="form-control"
        placeholder="E-mail"
        v-model.trim="state.form.email"
      >
      <span v-if="v$.form.email.$error">
        {{ v$.form.email.$errors[0].$message}}
      </span>
    </div>
    <div class="form-group">
      <input
        id="tel"
        class="form-control"
        placeholder="Телефон"
        v-model.trim="state.form.tel"
      >
      <span v-if="v$.form.tel.$error">
        {{ v$.form.tel.$errors[0].$message}}
      </span>
    </div>
    <button @click.prevent="submitForm(), createForm()" type="submit" class="btn">Отправить</button>
  </form>

  <h2>Заявки</h2>

  <hr>
  <table v-if="forms">
    <thead>
      <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Телефон</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(forms, idx) of forms" :key="forms">
        <td>{{ idx + 1}}</td>
        <td>{{ forms.name }}</td>
        <td>{{ forms.email }}</td>
        <td>{{ forms.tel }}</td>
      </tr>
    </tbody>
  </table>
  <p v-else>Список заявок пуст.</p>
</template>

<script>

import useVuelidate from '@vuelidate/core'
import { required, email, minLength } from '@vuelidate/validators'
import { reactive, computed } from 'vue'

export default {
  setup() {
    const state = reactive ({
      form: {
        name: '',
        email: '',
        tel: ''
      }
    })

    const rules = computed (() => {
      return {
        form: {
          name: { required },
          email: { required, email },
          tel: { required, minLength: minLength(11) }
        }
      }
    })

    const v$ = useVuelidate(rules, state)

    return {
      state, v$
    }
  },
  methods: {
    submitForm() {
     this.v$.$validate()
     if (!this.v$.$error) {
       alert('Отправка формы успешно выполнена!')
     }
     else {
       alert('Введенные данные не корректны!')
     }
    },
    createForm() {
      const forms = {
        name: this.state.form.name,
        email: this.state.form.email,
        tel: this.state.form.tel
      }
      this.$store.dispatch('getForm', forms)
    }
  },
  computed: {
    forms() {
      return this.$store.getters.forms
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
form {
  display: block;
  width: 500px;
  height: 230px;
  position: relative;
  border-radius: 10px;
  background-color: rgb(236, 179, 20);
  text-align: center;
  margin: 0 auto;
  padding: 10px;
}
h1 {
  font-size: 25px;
  font-style: italic;
  color: rgb(100, 64, 14);
}
h2 {
  margin-left: 20px;
  font-size: 25px;
  font-style: italic;
  color: rgb(100, 64, 14);
}
input {
  border-radius: 7px;
  border: none;
  margin: 8px;
  width: 190px;
  height: 22px;
  outline: none;

  &::placeholder {
    color: rgb(97, 95, 11);
    font-size: 14px;
    font-style: italic;
    opacity: 0.5;
  }

  &:focus {
    border: 2px solid rgb(131, 74, 4);
  }
}
button {
  margin: 10px;
  padding: 5px;
  width: auto;
  font-size: 14px;
  font-style: italic;
  font-weight: 700;
  border-radius: 10px;
  cursor: pointer;
  box-shadow: 4px 4px 15px 0px rgba(34, 111, 33, 0.2);
  background-color: rgba(122, 204, 16, 0.753);
  transition: background-color .2s linear;

  &:hover {
    background-color: rgb(21, 160, 21);
  }
}
span {
  color: rgb(52, 94, 94);
  font-size: 15px;
  font-weight: 600;
  font-style: italic;
}
p {
  font-style: italic;
  font-size: 16px;
  font-weight: 600;
}
table {
  width: 70%;
  margin: 0 auto;
  padding-top: 10px;
  font-style: italic;
  line-height: 1.4;
  text-align: center;
}
th {
  border: 1px solid rgb(143, 62, 62);
  padding: 2px;
  margin: 4px;
  font-size: 18px;
  border-radius: 5px;
}
td {
  border: 1px solid rgb(143, 62, 62);
  border-radius: 5px;
}
</style>
