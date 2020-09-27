export function LOAD_CATEGORIES(context, categories){
    context.commit('LOAD_CATEGORIES', categories)

}

export function LOAD_CHECKED_CAT(context, checkCatToSnap){
    context.commit('LOAD_CHECKED_CAT', checkCatToSnap)

}

export function CREATING_SUB_CATEGORY_STATUS(context, creatingSubCategoryStatus) {
    context.commit('CREATING_SUB_CATEGORY_STATUS', creatingSubCategoryStatus)
}

export function EDITING_CATEGORY_STATUS(context, editingCategoryStatus) {
    context.commit('EDITING_CATEGORY_STATUS', editingCategoryStatus)
}

export function SNAP_TO_CATEGORY_STATUS(context, snapToCategoryStatus) {
    context.commit('SNAP_TO_CATEGORY_STATUS', snapToCategoryStatus)
}
