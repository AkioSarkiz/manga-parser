import AppLayout from '@/components/Layouts/AppLayout'
import Head from 'next/head'
import {useParsedMangaIndex} from "@/hooks/parsedManga"
import {Box, Card, CardContent, CardHeader, CardMedia, Pagination, Stack, Typography} from "@mui/material"
import {useMemo, useState} from "react"

const Dashboard = () => {
    const [paginationPage, setPaginationPage] = useState(1)
    const {isError, isLoading, pagination} = useParsedMangaIndex(paginationPage)

    return (
        <AppLayout
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }>

            <Head>
                <title>MangaParser - Dashboard</title>
            </Head>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            {isError && <div>Failed load...</div>}
                            {isLoading && <div>Loading...</div>}
                            <Stack spacing={2}>
                                {!isLoading && pagination.items.map((item) =>
                                    <Card className="justify-between" sx={{display: 'flex'}} key={item.id}>
                                        <CardContent>
                                            <Typography
                                                variant={'h5'}
                                            >
                                                {item.parsed_data.title}
                                            </Typography>
                                            <Typography>
                                                {item.parsed_data.description}
                                            </Typography>
                                        </CardContent>
                                        <CardMedia
                                            sx={{width: 112, height: 175}}
                                            component="img"
                                            image={item.parsed_data.cover}
                                            alt="cover"
                                        />
                                    </Card>
                                )}

                                {!isLoading &&
                                    <Pagination
                                        count={pagination.last_page}
                                        color="primary"
                                        page={paginationPage}
                                        onChange={(e, value) => setPaginationPage(value)}
                                    />
                                }
                            </Stack>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    )
}

export default Dashboard
