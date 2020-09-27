export function LOAD_CATEGORIES(state, payload){
    state.categories = payload

}


export function LOAD_CHECKED_CAT(state, payload){
    state.checkCatToSnap = payload
}

export function CREATING_SUB_CATEGORY_STATUS(state, payload) {
    state.creatingSubCategoryStatus = payload
}

export function EDITING_CATEGORY_STATUS(state, payload) {
    state.editingCategoryStatus = payload
}

export function SNAP_TO_CATEGORY_STATUS(state, payload) {
    state.snapToCategoryStatus = payload
}
