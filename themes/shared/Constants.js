export const URL_BASE_API = "http://localhost/siboon/api/";

export function getAuthorization() {
    return localStorage.getItem("authorization");
}