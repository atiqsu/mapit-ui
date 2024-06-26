
export const assignedUserIds = users => users.filter(user => user.hasAccess ).map(user => user.id);
