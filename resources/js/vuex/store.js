import { createStore } from 'vuex';
import * as actions from './actions.js';
import * as mutations from './mutations.js';

const state = {
  sidebar: {
    opened: false
  }
};

export default createStore({
  state,
  actions,
  mutations
});
