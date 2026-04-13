import { Sandbox } from "@vercel/sandbox";

const test = await Sandbox.create();

const cmd = await Sandbox.runCommand("echo", ["Hello desde vercelStudio"]);
console.log(await cmd.stdout());

await test.stop();