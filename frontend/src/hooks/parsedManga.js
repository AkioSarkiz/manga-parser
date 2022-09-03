import useSWR from "swr"
import axios from "@/lib/axios"
import {useLengthAwarePaginator} from "@/hooks/pagination"

const useParsedMangaIndex = (page = 1) => {
    const {data, error} = useSWR(`api/parsed-manga?page=${page}`, axios);

    const isLoading = !error && !data;
    const isError = error;

    return {
        isLoading,
        isError,
        pagination: isLoading ? null : useLengthAwarePaginator(data.data),
    }
}

export {
    useParsedMangaIndex,
}
