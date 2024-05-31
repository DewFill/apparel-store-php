export class Fetcher {
    private method: string;
    private content_type: string = "application/json";
    private url: string;
    private body: object;
    private log: boolean;
    private loadingAnimationElement;
    private loadingAnimationPromise;

    constructor(request, url, body) {
        this.method = request;
        this.url = url;
        this.body = body;
    }

    static init(request = null, url = null, body = null): Fetcher {
        return new this(request, url, body);
    }

    setMethod(request: string) {
        //up upper case
        this.method = request.toUpperCase();
        return this;
    }

    setUrl(url: string) {
        this.url = url;
        return this;
    }

    setBody(body: object) {
        this.body = body;
        return this;
    }

    setContentType(content_type: string) {
        this.content_type = content_type;
        return this;
    }

    private static parseResponse(response) {
        console.log(response.instruction)
        return {
            status: response["status"],
            isSuccess: response.status === "success",
            body: response.body,
            data: response.data,
            error: response.error,
            instruction: response.instruction,
            url: response.url,
            raw_data: response
        }
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
            .then(data => Fetcher.parseResponse(data))
    }

    private static instructionExecuter(instruction) {
        const command = instruction[0];
        const args = instruction[1];

        switch (command) {
            case "goto":
                window.location.href = args;
                break;
        }
    }
}