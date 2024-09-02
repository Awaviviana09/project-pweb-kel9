const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"index":{"uri":"\/","methods":["GET","HEAD"]},"storeTask":{"uri":"storeTask","methods":["POST"]},"destroyTask":{"uri":"destroyTask","methods":["DELETE"]},"editTask":{"uri":"editTask","methods":["GET","HEAD"]},"UpdateTask":{"uri":"updateTask","methods":["PUT"]},"auth.logout":{"uri":"logout","methods":["POST"]},"auth.form":{"uri":"login","methods":["GET","HEAD"]},"auth.register":{"uri":"register","methods":["POST"]},"auth.login":{"uri":"login","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
