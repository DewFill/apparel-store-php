export class Fetcher {
    method;
    content_type = "application/json";
    url;
    body;
    log;
    loadingAnimationElement;
    loadingAnimationPromise;
    constructor(request, url, body) {
        this.method = request;
        this.url = url;
        this.body = body;
    }
    static init(request = null, url = null, body = null) {
        return new this(request, url, body);
    }
    setMethod(request) {
        //up upper case
        this.method = request.toUpperCase();
        return this;
    }
    setUrl(url) {
        this.url = url;
        return this;
    }
    setBody(body) {
        this.body = body;
        return this;
    }
    setContentType(content_type) {
        this.content_type = content_type;
        return this;
    }
    static parseResponse(response) {
        console.log(response.instruction);
        return {
            status: response["status"],
            isSuccess: response.status === "success",
            body: response.body,
            data: response.data,
            error: response.error,
            instruction: response.instruction,
            url: response.url,
            raw_data: response
        };
    }
    fetch() {
        return window.fetch(this.url, {
            headers: {
                "Content-Type": this.content_type
            },
            method: this.method,
            body: JSON.stringify(this.body)
        })
            .then(response => response.json())
            .then(data => Fetcher.parseResponse(data));
    }
    static instructionExecuter(instruction) {
        const command = instruction[0];
        const args = instruction[1];
        switch (command) {
            case "goto":
                window.location.href = args;
                break;
        }
    }
}
//# sourceMappingURL=Fetcher.js.map