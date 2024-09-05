import { usePage } from "@inertiajs/vue3";

export function usePermission() {
  const hasRole = (name) => {
    const roleName = name.toLowerCase();

    return (
      usePage().props?.auth?.user?.roles?.some(
        (role) => role.name?.toLowerCase() === roleName
      ) ?? false
    );
  };

  const hasPermission = (name) => {
    const permissionName = name.toLowerCase();

    return (
      usePage().props?.auth?.user?.permissions?.some(
        (permission) => permission.name?.toLowerCase() === permissionName
      ) ?? false
    );
  };

  return { hasRole, hasPermission };
}