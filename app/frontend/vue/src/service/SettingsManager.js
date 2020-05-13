export default {
    get(setting) {
        return localStorage.getItem(setting)
    },
    set(setting, value) {
        localStorage.setItem(setting, value);
    },
    remove(setting) {
        localStorage.removeItem(setting);
    },
    has(setting) {
        return !!this.get(setting);
    }
}
